<?php

namespace App\Service;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService 
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getApiData(): array
    {
        $response = $this->client->request(
            'GET',
            //'https://api.github.com/repos/symfony/symfony-docs'
           // 'http://127.0.0.1:8001/api/customers'
           'https://coronavirusapifr.herokuapp.com/data/live/france'
        );


        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}