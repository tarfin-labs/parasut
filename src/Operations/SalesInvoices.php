<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\ApiClient;

class SalesInvoices extends AbstractOperation
{
    protected $endPoint = 'sales_invoices';

    protected $filterables = ['issue_date', 'due_date', 'spender_id'];

    protected $include = 'sales_invoice_details';

    protected $sortables = [
        'id', 'issue_date', 'due_date', 'remaining', 'remaining_in_trl',
        '-id', '-issue_date', '-due_date', '-remaining', '-remaining_in_trl',
    ];

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
    }
}
