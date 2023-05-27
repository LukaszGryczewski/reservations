<?php

namespace App\Services;

use GuzzleHttp\Client;

class TheatreContemporainService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('API_THEATRE_KEY');
        $this->baseUrl = config('THEATRE_CONTEMPORAIN_BASE_URL');
    }

    public function getShows()
    {
        $url = $this->baseUrl . '/shows';

        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    // Other methods for interacting with the API...
}
