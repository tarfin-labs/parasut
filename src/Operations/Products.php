<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\ApiClient;

class Products extends AbstractOperation
{
    protected $endPoint = 'products';
    protected $filterables = ['name', 'code'];
    protected $sortables = ['id', 'name', '-id', '-name'];

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
    }

    public function getIdByName($name)
    {
        $contact = $this->index([
            'filter' => ['name' => $name],
            'sort'   => '-id',
            'page'   => ['number' => 1, 'size' => 1],
        ]);

        if (empty($contact['data'])) {
            return;
        }

        return $contact['data'][0]['id'];
    }
}
