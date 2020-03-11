<?php

namespace TarfinLabs\Parasut;

class Parasut
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = $this->getApiClient();
    }

    private function getApiClient()
    {
        return app()->make(ApiClient::class);
    }

    public function __call($name, $args)
    {
        $resource = sprintf(__NAMESPACE__.'\\Operations\\'.ucfirst($name));
        if (!class_exists($resource)) {
            throw new \Exception('Unknown resource:'.$name);
        }

        return new $resource($this->apiClient);
    }
}
