<?php

namespace App\Services;

use GuzzleHttp\Client;

class TicketmasterService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

     public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.ticketmaster.api_key');
        $this->baseUrl = config('services.ticketmaster.base_url');
    }

    public function searchEvents($keyword)
    {
        $url = $this->baseUrl . '/discovery/v2/events.json';

        $response = $this->client->request('GET', $url, [
            'query' => [
                'keyword' => $keyword,
               // 'countryCode' => $countryCode,
                'apikey' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    // Autres méthodes pour interagir avec l'API Ticketmaster...
}
