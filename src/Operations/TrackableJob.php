<?php

namespace TarfinLabs\Parasut\Operations;

use TarfinLabs\Parasut\ApiClient;

class TrackableJob extends AbstractOperation
{
    protected $endPoint = 'trackable_jobs';

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
    }
}
