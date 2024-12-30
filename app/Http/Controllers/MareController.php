<?php

namespace App\Http\Controllers;

use App\Models\Mare;
use App\Models\Picture;
use Illuminate\Validation\Rules\File;

class MareController extends Controller
{
    //
    private function prepareMarkers() {
        return Mare::with(['user:id,name', 'pictures:id,mare_id,path'])->get()->map(function ($mare) {
            $marker = [
                'latlng' => [$mare->latitude, $mare->longitude],
                'mare_id' => $mare->id,
            ];

            if ($mare->pictures->isNotEmpty()) {
                $marker['picture'] = $mare->pictures->first()->path;
            }

            return $marker;
        })->values();
    }

    public function index() {
        $markers = $this->prepareMarkers();

        return view('mares.index', [
            'markers' => $markers
        ]);
    }


    public function create() {
        $markers = $this->prepareMarkers();

        return view('mares.create', [
            'markers' => $markers
        ]);
    }


    public function edit(Mare $mare)
    {

        $markers = $this->prepareMarkers();

        // Recherche et suppression du marker en cours d'edition : il ne sera pas affiche, ce qui permettra ensuite de le poser sur la carte et de le deplacer
        // On aurait pu faire autrement cote javascript, mais cette solution semble la plus econome, le mieux serait meme de revoir preparemarker et de
        // lui passer en parametre le marker a ne pas stocker, ce qui enlevera une etape
        $key=array_search($mare->id, array_column($markers->toArray(), 'mare_id'));
        $markers->forget($key);


        return view('mares.edit', [
            'markers' => $markers,
            'mare' => $mare
        ]);
    }


    public function show(Mare $mare)
    {

        $mare = Mare::with(['pictures.user'])->find($mare->id);

        return view('mares.show', [
            'mare' => $mare
        ]);
    }





    public function store()
    {


        request()->validate(
            [
                'latitude' => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$/'],
                'longitude' => ['required', 'regex:/^(\+|-)?(?:18,0(?:(?:\.0{1,7})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$/'],
                'picture' => [File::types(['png', 'jpg'])],
                'observed_at' =>['nullable','date_format:Y-m-d H:i']
            ]
        );

        $mare=Mare::create([
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'user_id' => Auth()->id(),
        ]);

        if (request()->hasFile('picture')) {
            $picturePath = request()->picture->store('pictures','public');
            Picture::create([
                'path' => $picturePath,
                'user_id' => Auth()->id(),
                'mare_id' => $mare->id,
                'observed_at' => request('observed_at')
            ]);
        }




        return redirect('/mares');
    }


    public function update(Mare $mare) {

        // https://gist.github.com/arubacao/b5683b1dab4e4a47ee18fd55d9efbdd1 Latitude Longitude Regular Expression Validation PHP


        request()->validate(
            [
                'latitude' => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$/'],
                'longitude' => ['required', 'regex:/^(\+|-)?(?:180(?:(?:\.0{1,7})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$/']
            ]
        );


        $mare->update([
            'latitude' => request('latitude'),
            'longitude' => request('longitude')
        ]);

        return redirect('/mares/' . $mare->id);
    }

    public function destroy(Mare $mare) {


        $mare->delete();
        return redirect('/mares');
    }
}
