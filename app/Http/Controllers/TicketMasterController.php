<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TicketmasterController extends Controller
{
    public function getTheatreData(Request $request)
    {
        $client = new Client(['base_uri' => 'https://app.ticketmaster.com/discovery/v2/']);
        $response = $client->request('GET', 'events.json', [
            'query' => [
                'apikey' => 'zFHSVs06rjPtIarx1EOSAZB8Alu3z6r0',
                'classificationName' => 'theatre',
                'countryCode' => 'BE'
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        // Récupérer le numéro de page à partir de la requête, par défaut 1 si non spécifié
        $page = $request->query('page', 1);

        // Limiter le nombre de spectacles affichés à 9
        $perPage = 9;

        // Créer une instance Paginator avec les données, la taille de la page et le nombre total d'éléments
        $theatres = new \Illuminate\Pagination\LengthAwarePaginator(
            array_slice($data['_embedded']['events'], ($page - 1) * $perPage, $perPage), // Données à paginer
            count($data['_embedded']['events']), // Total des éléments
            $perPage, // Nombre d'éléments par page
            $page, // Numéro de la page actuelle
            ['path' => $request->url()] // URL de base pour les liens de pagination
        );

        return view('theatres', ['theatres' => $theatres]);
    }
}
