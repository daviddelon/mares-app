<?php

namespace App\Http\Controllers;

use App\Models\Mare;
use App\Models\Picture;
use Illuminate\Validation\Rules\File;

class MareController extends Controller
{
    //

    public function index()
    {

        $mares = Mare::with('user')->latest()->paginate(3); // prevent lazy loading



        $markers = Mare::with(['user','pictures'])->get()->map(function ($mare) {


            $path='';
            foreach ($mare->pictures as $picture) {
                $path=$picture->path;
            }

            return [
                    'latlng' => [$mare->latitude, $mare->longitude],
                    'content' => $mare->user->name,
                    'mare_id' => $mare->id,
                    'picture' => $path
                ];
        })->values();



        return view('mares.index', [
            'mares' => $mares,'markers'=>$markers
        ]);
    }

    public function create()
    {

        $markers = Mare::with('user')->get()->map(function ($mare) {

            return [
                    'latlng' => [$mare->latitude, $mare->longitude],
                    'content' => $mare->user->name


                ];
        })->values();






        return view('mares.create', [
            'markers'=>$markers
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
            $picturePath = request()->picture->store('pictures');
            Picture::create([
                'path' => $picturePath,
                'user_id' => Auth()->id(),
                'mare_id' => $mare->id,
                'observed_at' => request('observed_at')
            ]);
        }




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
