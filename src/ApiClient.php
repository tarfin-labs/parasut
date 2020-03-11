<?php

namespace TarfinLabs\Parasut;

use GuzzleHttp\Client;

class ApiClient
{
    private $httpClient;
    private $apiUrl;
    private $baseUrl;
    private $config;
    private $token;
    private $refreshToken;

    public function __construct()
    {
        $config = config('services.parasut');

        $this->httpClient = new Client();
        $this->baseUrl = $config['base_uri'];
        $this->apiUrl = $config['base_uri'].'/'.$config['version'].'/'.$config['company_id'];
        $this->config = $config;

        $this->authorize();
    }

    private function authorize()
    {
        $options = [
            'form_params' => [
                'grant_type'    => $this->config['grant_type'],
                'client_id'     => $this->config['client_id'],
                'client_secret' => $this->config['client_secret'],
                'username'      => $this->config['username'],
                'password'      => $this->config['password'],
                'redirect_uri'  => $this->config['redirect_uri'],
            ],
        ];

        $response = $this->httpClient->post($this->baseUrl.'/oauth/token', $options);
        $response = json_decode($response->getBody()->getContents());
        $this->token = $response->access_token;
        $this->refreshToken = $response->refresh_token;
    }

    public function call($method, $endpoint, $queryParams = [], $bodyParams = [], $headers = [])
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$this->token,
                'Accept'        => 'application/json',
            ],
            'json'    => $bodyParams,
        ];

        $options['headers'] = array_merge($options['headers'], $headers);
        $url = $this->apiUrl.'/'.$endpoint;
        $url .= empty($queryParams) ? '' : '?'.http_build_query($queryParams);
        $response = $this->httpClient->request($method, $url, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getXml($method, $endpoint)
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$this->token,
                'Accept'        => 'application/json',
            ],
        ];

        $url = $this->apiUrl.'/'.$endpoint;
        $response = $this->httpClient->request($method, $url, $options);

        return $response->getBody()->getContents();
    }
}
