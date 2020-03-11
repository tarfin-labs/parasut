<?php

namespace TarfinLabs\Parasut;

class ParasutResponse
{
    private $data;
    private $links;
    private $meta;

    private $apiClient;

    public function __construct($response, ApiClient $apiClient)
    {
        $this->data = $response['data'];
        $this->links = $response['links'];
        $this->meta = $response['meta'];
        $this->apiClient = $apiClient;

        return $this;
    }
}
