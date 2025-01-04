<?php

namespace App\Http\Controllers;

use App\Models\Kv;
use App\Models\Mare;
use App\Models\Picture;
use Illuminate\Validation\Rules\File;

class MareController extends Controller
{

    private function prepareMarkers($mare_id=null) {

        // Lors d'une modificiation un identifiant mare est transmis : on ne souhaite pas qu'il apparaisse dans la collection
        // des markers car il ne faut pas l'afficher comme marker fixe mais comme marker deplacable

        return Mare::with(['user', 'pictures', 'kvs'])->get()->map(function ($mare) use ($mare_id) {

            if ($mare_id != $mare->id) {
                $marker = [
                    'latlng' => [$mare->latitude, $mare->longitude],
                    'mare_id' => $mare->id,
                ];

                if ($mare->pictures->isNotEmpty()) {
                    $marker['picture'] = $mare->pictures->first()->path;
                }


                if ($mare->kvs->isNotEmpty()) {
                    $filtered = $mare->kvs->where('identifier', 'name')->first();

                    if ($filtered) {
                        $marker['name'] = $filtered->content;
                    }
                }


                return $marker;
            }
        })->filter()->values(); // filter pour supprimer la valeur null liee a l'identifiant mare transmis
    }

    public function index() {

        // On affiche tous les markers
        $markers = $this->prepareMarkers();


        return view('mares.index', [
            'markers' => $markers
        ]);
    }


    public function create() {

        // On affiche tous les markers

        $markers = $this->prepareMarkers();

        return view('mares.create', [
            'markers' => $markers
        ]);
    }


    public function edit(Mare $mare)
    {

        // On affiche tous les markers sauf le marker modifie, pour pouvoir le deplacer
        $markers = $this->prepareMarkers($mare->id);

        $mare = Mare::with(['pictures.user','kvs'])->find($mare->id);

        $name = null;

        if ($mare->kvs->isNotEmpty()) {
            $filtered = $mare->kvs->where('identifier', 'name')->first();

            if ($filtered) {
                $name = $filtered->content;
            }
        }

        return view('mares.edit', [
            'markers' => $markers,
            'mare' => $mare,
            'name' =>$name
        ]);


    }


    public function show(Mare $mare)
    {


        $mare = Mare::with(['pictures.user','kvs'])->find($mare->id);


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
                'name' => ['string', 'max:255'],
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

        if (request()->has('name')) {
            Kv::create([
                'identifier' => 'name',
                'content' => request('name'),
                'user_id' => Auth()->id(),
                'mare_id' => $mare->id,
            ]);
        }




        return redirect('/mares');
    }


    public function update(Mare $mare) {

        // https://gist.github.com/arubacao/b5683b1dab4e4a47ee18fd55d9efbdd1 Latitude Longitude Regular Expression Validation PHP


        request()->validate(
            [
                'latitude' => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$/'],
                'longitude' => ['required', 'regex:/^(\+|-)?(?:180(?:(?:\.0{1,7})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$/'],
                'picture' => [File::types(['png', 'jpg'])],
                'name' => ['string', 'max:255'],
                'observed_at' =>['nullable','date_format:Y-m-d H:i']
            ]
        );

        $mare->update([
            'latitude' => request('latitude'),
            'longitude' => request('longitude')
        ]);

        // Ajout et pas modification

        if (request()->hasFile('picture')) {
            $picturePath = request()->picture->store('pictures','public');
            Picture::create([
                'path' => $picturePath,
                'user_id' => Auth()->id(),
                'mare_id' => $mare->id,
                'observed_at' => request('observed_at')
            ]);
        }

        if (request()->has('name')) {
            $existingKvs = $mare->kvs->where('identifier', 'name')->first();

            if ($existingKvs) {
                $existingKvs->update([
                    'content' => request('name'),
                    'user_id' => Auth()->id(),
                    'mare_id' => $mare->id,
                ]);
            } else {
                $mare->kvs()->create([
                    'identifier' => 'name',
                    'content' => request('name'),
                    'user_id' => Auth()->id(),
                    'mare_id' => $mare->id,
                ]);
            }
        }


        return redirect('/mares/' . $mare->id);
    }

    public function destroy(Mare $mare) {


        $mare->delete();
        return redirect('/mares');
    }
}
