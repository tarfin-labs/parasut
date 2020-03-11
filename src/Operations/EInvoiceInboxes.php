<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\Exceptions\ParasutException;
use GuzzleHttp\Exception\ClientException;

class EInvoiceInboxes extends AbstractOperation
{
    protected $endPoint = 'e_invoice_inboxes';

    /**
     * @param $response
     * @return bool|string
     */
    public function extractEmailFromResponse($response)
    {
        if (!isset($response['data']) || count($response['data']) == 0) {
            return false;
        }

        $inboxes = array_map(function ($item) {
            return $item['attributes']['e_invoice_address'];
        }, $response['data']);

        return $inboxes[0];
    }

    /**
     * @param $identifier
     * @return bool|string
     */
    public function getEInvoiceInbox($identifier)
    {
        try {
            $response = $this->client->call('GET', $this->endPoint.'/?filter[vkn]='.$identifier);

            return $this->extractEmailFromResponse($response);
        } catch (ClientException $exception) {
            $code = $exception->getCode();
            throw call_user_func(ParasutException::class.'::_'.$code, $exception);
        }
    }
}
