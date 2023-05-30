<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Artist;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Representation;
use Illuminate\Support\Facades\Gate;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Show::paginate(9);
        return view('show.index',[
            'shows'    => $shows,
            'resource' => 'spectacles'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (! Gate::allows('create-show')) {
            abort(403);
        }*/

        $artists = Artist::all();
        $locations = Location::all();

        return view('show.create', compact('artists', 'locations'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validated = $request->validate([
            'slug'=>'required|max:60',
            'title'=>'required|max:255'
        ]);

        //Le formulaire a été validé, nous créons un nouvel show à insérer
        $show = new Show();

        //Assignation des données et sauvegarde dans la base de données
        $show->slug = $validated['slug'];
        $show->title = $validated['title'];
        $show->bookable = $request->has('bookable');

        $show->save();

        return redirect()->route('show.index');*/

        /*$request->validate([
            'slug' => 'required',
            'title' => 'required',
            'poster_url' => 'nullable|url',
            'location_id' => 'required',
            'price' => 'required|numeric',
            'bookable' => 'nullable|boolean',
            'artists' => 'required|array',
            'artists.*' => 'exists:artists,id',
            'representations' => 'required|array',
            'representations.*.when' => 'required|date',
            'representations.*.location' => 'required|exists:locations,id',
        ]);

        // Création du spectacle
        $show = new Show();
        $show->slug = $request->input('slug');
        $show->title = $request->input('title');
        $show->poster_url = $request->input('poster_url');
        $show->location_id = $request->input('location_id');
        $show->price = $request->input('price');
        $show->bookable = $request->has('bookable');
        //$show->bookable = $request->input('bookable', false);
        $show->save();

        // Ajout des artistes associés
        $collaborateurs = $request->input('artists');
        //$show->artistTypes()->attach($artists);
        foreach($show->artistTypes as $at) {
            $collaborateurs[$at->type->type][] = $at->artist;
        }

        // Ajout des représentations
        $representations = $request->input('representations');
        foreach ($representations as $representationData) {
            $representation = new Representation();
            $representation->show_id = $show->id;
            $representation->when = $representationData['when'];
            $representation->location_id = $representationData['location_id'];
            $representation->save();
        }

        // Redirection vers la liste des spectacles
        return redirect()->route('show.index');*/
        $request->validate([
            'slug' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'poster_url' => 'nullable|url',
            'location_id' => 'required',
            'price' => 'required|numeric',
            'bookable' => 'nullable|boolean',
            'artists' => 'required|array',
            'artists.*' => 'exists:artists,id',
            'representations' => 'required|array',
            'representations.*.when' => 'required|date',
            'representations.*.location_id' => 'required|exists:locations,id',
        ]);

        $show = new Show();
        $show->slug = $request->input('slug');
        $show->title = $request->input('title');
        $show->description = $request->input('description');
        $show->poster_url = $request->input('poster_url');
        $show->location_id = $request->input('location_id');
        $show->price = $request->input('price');
        $show->bookable = $request->has('bookable');
        $show->save();

        $artists = $request->input('artists');
        foreach ($artists as $artistId) {
            $show->artistTypes()->attach($artistId);
        }

        $representations = $request->input('representations');
        foreach ($representations as $representationData) {
            $representation = new Representation();
            $representation->show_id = $show->id;
            $representation->when = $representationData['when'];
            $representation->location_id = $representationData['location_id'];
            $representation->save();
        }

        return redirect()->route('show.index');
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
        /*if (! Gate::allows('create-show')) {
            abort(403);
        }*/
        $show = Show::find($id);

        return view('show.edit',[
            'show' => $show,
        ]);
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
        //Validation des données du formulaire
        $validated = $request->validate([
            'slug' => 'required|max:60',
            'title' => 'required|max:255',
        ]);

	   //Le formulaire a été validé, nous récupérons l’artiste à modifier
        $show = Show::find($id);

	   //Mise à jour des données modifiées et sauvegarde dans la base de données
        $show->update($validated);

        return view('show.show',[
            'show' => $show,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (! Gate::allows('create-show')) {
            abort(403);
        }*/
        Representation::where('show_id', $id)->delete();
        Show::destroy($id);
        return redirect()->route('show.index');
    }
}
