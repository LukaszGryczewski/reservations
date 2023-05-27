<?php

namespace App\Http\Controllers;

use App\Models\Show;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;
use App\Services\RessourcesTheatreService;
use App\Services\TheatreContemporainService;
use App\Services\TicketmasterService;

class ShowAPIController extends Controller
{

    /*protected $theatreService;*/

    /*public function __construct(TheatreContemporainService $theatreService)
    {
        $this->theatreService = $theatreService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketmasterService = new TicketmasterService();

    // Récupère les spectacles
    $shows = $ticketmasterService->searchEvents('spectacle');

    // Récupère les concerts
    $concerts = $ticketmasterService->searchEvents('concert');

    // Récupère les pièces de théâtre
    $theatrePlays = $ticketmasterService->searchEvents('théâtre');

    return view('apii.index', compact('shows', 'concerts', 'theatrePlays'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Show::find($id);
        /*$ressourcesTheatreService = new RessourcesTheatreService();
        $show = $ressourcesTheatreService->getSpectacle($id);
*/
        //Récupérer les artistes du spectacle et les grouper par type
        $collaborateurs = [];

        foreach($show->artistTypes as $at) {
            $collaborateurs[$at->type->type][] = $at->artist;
        }
        return view('show.show',[
            'show' => $show,
            'collaborateurs' => $collaborateurs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
