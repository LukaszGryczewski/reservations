<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Théâtre Contemporain API Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for configuring the Theatre Contemporain API integration.
    | Here, you can specify the API key and other settings required.
    |
    */

    'api_key' => env('API_THEATRE_KEY', 'e3184fb6d32bdadd12f037a85ff2a38f478b0469'),

    'base_url' => env('THEATRE_CONTEMPORAIN_BASE_URL', 'https://api.theatre-contemporain.net'),

    // Other configuration options...
];
