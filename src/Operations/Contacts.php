<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\ApiClient;

class Contacts extends AbstractOperation
{
    protected $endPoint = 'contacts';
    protected $filterables = ['name', 'email', 'tax_number', 'tax_office', 'city'];
    protected $sortables = ['id', 'balance', 'name', 'email', '-id', '-balance', '-name', '-email'];

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
    }

    /**
     * Retrieve contact by tax number.
     * @param $taxNumber
     * @return int|null
     */
    public function getIdByTaxNumber($taxNumber)
    {
        $contact = $this->index([
            'filter' => ['tax_number' => $taxNumber],
            'sort'   => '-id',
            'page'   => ['number' => 1, 'size' => 1],
        ]);

        if (empty($contact['data'])) {
            return;
        }

        return $contact['data'][0]['id'];
    }
}
