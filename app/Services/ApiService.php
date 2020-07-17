<?php

namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ApiService
{
    private $client;

    public function __construct(array $headers = [])
    {
        $headers = array_merge($headers, [
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ]);

        $this->client = new Client([
            'headers' => $headers
        ]);
    }

//    public function request(string $method, string $url, array $data = [])
//    {
//        try {
//            $response = $this->client->request(strtoupper($method), $url, $data);
//        } catch (RequestException $e) {
//            $response = $e->getResponse();
//        }
//        return $response;
//    }

    public function getRequestPage(string $url, array $data = [])
    {
        return $this->request('GET', $url, $data)->getBody()->getContents();
    }

    public function requestJson(string $method, string $url, array $data = [])
    {
        return $this->request($method, $url, ['json' => $data]);
    }

    public function request(string $method, string $url, array $data = []): ResponseInterface
    {
        return $this->client->request(strtoupper($method), $url, $data);
    }

    public function getRequest($url, $options = []): ResponseInterface
    {
        return $this->client->get($url, $options);
    }

    public function postRequest($url, $params = []): ResponseInterface
    {
        return $this->client->post($url, $params);
    }
}
