<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ParksData
{

    private HttpClientInterface $client;
    private ParameterBagInterface $params;
    private string $auth_token;
   
    public function __construct(HttpClientInterface $client, ParameterBagInterface $params)
    {
        $this->client = $client;
        $this->params = $params;
        $this->auth_token = $this->params->get('nps_key');

    }

    public function fetchAllParksData()
    {   
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
