<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ParksData
{

    private HttpClientInterface $client;
    private string $auth_token = 'El1hqEu0lJbZg4QNSdnzJ4AbuxlzpbgkcJcAWTl7';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchAllParksData()
    {
        //NPS token : El1hqEu0lJbZg4QNSdnzJ4AbuxlzpbgkcJcAWTl7
        $response = $this->client->request(
            'GET',
            'https://developer.nps.gov/api/v1/parks',
            [
                'headers' =>
                [
                    'X-Api-Key' => $this->auth_token,
                ],
            ]
        );
       return $response->toArray();
    }

public function fetchParksDatabyState(string $stateCode){
    $response = $this->client->request(
        'GET',
        'https://developer.nps.gov/api/v1/parks?stateCode='. strtolower($stateCode),
        [
            'headers' =>
            [
                'X-Api-Key' => $this->auth_token,
            ],
        ]
    );
   return $response->toArray();

}
}
