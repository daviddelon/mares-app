<?php

namespace App\Http\Controllers;

use App\Models\Mare;

class MareController extends Controller
{
    //

    public function index()
    {

        $mares = Mare::with('user')->latest()->paginate(3); // prevent lazy loading

        $markers = Mare::all()->map(function ($event, $key) {

            return [
                    'latlng' => [$event->latitude, $event->longitude],

                ];
        })->values();

        return view('mares.index', [
            'mares' => $mares,'markers'=>$markers
        ]);
    }

    public function create()
    {


        return view('mares.create');
    }

    public function show(Mare $mare)
    {

        return view('mares.show', [
            'mare' => $mare
        ]);
    }


    public function store()
    {

        request()->validate(
            [
                'latitude' => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$/'],
                'longitude' => ['required', 'regex:/^(\+|-)?(?:180(?:(?:\.0{1,7})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$/']
            ]
        );

        Mare::create([
            'latitude' => request('latitude'),
            'longitude' => request('longitude'),
            'user_id' => Auth()->id()
        ]);

        return redirect('/mares');
    }


    public function edit(Mare $mare)
    {


        return view('mares.edit', [
            'mare' => $mare
        ]);
    }

    public function update(Mare $mare)
    {

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

    public function destroy(Mare $mare)
    {


        $mare->delete();
        return redirect('/mares');
    }
}
