<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\ApiClient;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Log;
use TarfinLabs\Parasut\Exceptions\ParasutException;

abstract class AbstractOperation
{
    const pagination = ['size', 'number'];

    protected $client;
    protected $endPoint = '';
    protected $filterables = [];
    protected $include = [];
    protected $sortables = [];

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $search
     * @return mixed
     * @throws Exception
     */
    public function index($search = [])
    {
        try {
            $queryParams = $this->fillQueryParams($search);

            return $this->client->call('GET', $this->endPoint, $queryParams);
        } catch (ClientException $exception) {
            $code = $exception->getCode();
            if ($code == 429) {
                Log::debug("Waiting for 60 sec. because of parasut rate limit!!\n");
                sleep(60);

                return $this->index($search);
            }
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    /**
     * @param $search
     * @return array
     * @throws Exception
     */
    protected function fillQueryParams($search)
    {
        $queryParams = [];

        if (!empty($search)) {
            if (!empty($search['include'])) {
                $queryParams['include'] = implode(',', $search['include']);
            }

            if (isset($search['filter'])) {
                if (!is_array($search['filter'])) {
                    throw new Exception('Filter parameter must be array, but '.gettype($search['filter']));
                }

                $queryParams['filter'] = array_intersect_key($search['filter'], array_flip($this->filterables));
            }

            if (isset($search['sort'])) {
                if (!is_string($search['sort'])) {
                    throw new Exception('Sort parameter must be string, but '.gettype($search['sort']));
                }

                if (!in_array($search['sort'], $this->sortables)) {
                    throw new Exception('Sort parameter must be one of ['.implode(',', $this->sortables).']');
                }

                $queryParams['sort'] = $search['sort'];
            }

            if (isset($search['page'])) {
                if (!is_array($search['page'])) {
                    throw new Exception('Filter parameter must be array, but '.gettype($search['page']));
                }

                $queryParams['page'] = array_intersect_key($search['page'], array_flip(self::pagination));
            }
        }

        return $queryParams;
    }

    /**
     * @param $data
     * @param array $include
     * @return mixed
     */
    public function create($data, $include = [])
    {
        try {
            $data['data']['type'] = $this->endPoint;

            Log::debug('Creating : '.$data['data']['type']);

            if (!empty($include)) {
                $include = ['include' => implode(',', $include)];
            }

            return $this->client->call('POST', $this->endPoint, $include, $data);
        } catch (ClientException $exception) {
            $code = $exception->getCode();
            if ($code == 429) {
                echo "Waiting for 60 sec. because of parasut rate limit!!\n";
                sleep(60);

                return $this->create($data, $include);
            }

            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function show($id, $include = [])
    {
        try {
            $data['data']['type'] = $this->endPoint;

            if (!empty($include)) {
                $include = ['include' => implode(',', $include)];
            }

            return $this->client->call('GET', $this->endPoint.'/'.$id, $include);
        } catch (ClientException $exception) {
            $code = $exception->getCode();
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function showPdf($id, $include = [])
    {
        try {
            Log::debug('Getting pdf : '.$this->endPoint, [
                'id' => $id,
            ]);

            $data['data']['type'] = 'e_document_pdfs';

            if (!empty($include)) {
                $include = ['include' => implode(',', $include)];
            }

            return $this->client->call('GET', $this->endPoint.'/'.$id.'/pdf', $include);
        } catch (ClientException $exception) {
            $code = $exception->getCode();
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function delete($id, $include = [])
    {
        try {
            Log::debug('Deleting : '.$this->endPoint, [
                'id' => $id,
            ]);

            if (!empty($include)) {
                $include = ['include' => implode(',', $include)];
            }

            return $this->client->call('DELETE', $this->endPoint.'/'.$id, $include);
        } catch (Exception $exception) {
            $code = $exception->getCode();
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function cancel($id, $include = [])
    {
        try {
            Log::debug('Cancelling : '.$this->endPoint, [
                'id' => $id,
            ]);

            if (!empty($include)) {
                $include = ['include' => implode(',', $include)];
            }

            return $this->client->call('DELETE', $this->endPoint.'/'.$id.'/cancel', $include);
        } catch (Exception $exception) {
            $code = $exception->getCode();
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }

    /**
     * @param $id
     * @param array $include
     * @return mixed
     */
    public function archive($id, $include = [])
    {
        try {
            Log::debug('Archiving : '.$this->endPoint, [
                'id' => $id,
            ]);

            if (!empty($include)) {
                $include = ['include' => implode(',', $include)];
            }

            return $this->client->call('PATCH', $this->endPoint.'/'.$id.'/archive', $include);
        } catch (Exception $exception) {
            $code = $exception->getCode();
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }
}
