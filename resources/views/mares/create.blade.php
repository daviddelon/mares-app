<x-layout>

    @push('flatpickr')
        <x-flatpickr::style />
    @endpush


    <x-slot:heading>
        Nouvelle Mare
    </x-slot:heading>



    <script type="module">
        <x-map :markers="$markers"> </x-map>

        var theMarker;

        function updateLatLng(latlng) {

            const latitude = parseFloat(latlng.lat.toString().substring(0, 15)).toFixed(7);
            const longitude = parseFloat(latlng.lng.toString().substring(0, 15)).toFixed(7);

            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        }


        map.on('click', function(e) {
            const latlng = e.latlng;

            if (theMarker) {
                map.removeLayer(theMarker);
            }


            theMarker = L.marker([latlng.lat, latlng.lng], { draggable: true }).addTo(map);
            theMarker.on('move', function(event) {
                updateLatLng(event.latlng);
            });


            updateLatLng(latlng);


        });
    </script>




    <form method="POST" action="/mares" enctype="multipart/form-data">

        @csrf

        <div class="container w-full h-screen flex flex-col md:flex-row">



            <div class="mx-5 border-2 p-2 split basis-2/3">
                <div class="h-full md:h-2/3" id="map">
                </div>
            </div>


            <div class="mx-5 border-2 p-2 split basis-1/3">


                <div class="flex gap-2 mt-4">
                    <div class="w-full">
                        <x-form-label for="latitude">Latitude</x-form-label>
                        <x-form-input class="w-full text-xl px-4 py-2 mt-1"
                                      type="text" name="latitude" id="latitude" placeholder="45.33445" :value="old('latitude')" required>
                        </x-form-input>
                        <x-form-error name="latitude"></x-form-error>

                    </div>
                    <div class="w-full">
                        <x-form-label for="longitude">Longitude</x-form-label>
                        <x-form-input class="w-full text-xl px-4 py-2 mt-1"
                                      type="text" name="longitude" id="longitude" placeholder="3.23445" :value="old('longitude')" required>
                        </x-form-input>
                        <x-form-error name="longitude"></x-form-error>


                    </div>
                </div>


                <div class="flex gap-2 mt-4">
                    <div class="w-full">
                        <x-form-label for="name">Nom</x-form-label>
                        <x-form-input class="w-full text-xl px-4 py-2 mt-1"
                                      type="text" name="name" id="name" :value="old('name')" >
                        </x-form-input>
                        <x-form-error name="name"></x-form-error>


                    </div>

                </div>



                <div class="flex gap-2 mt-4">
                    <div class="w-full">

                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                              <x-flatpickr class="!block !flex-1 !border-0 !bg-transparent !py-1.5 !px-3 !pl-1 !text-gray-900 !placeholder:text-gray-400 !focus:ring-0 sm:text-sm sm:leading-6 !w-full" first-day-of-week="1" show-time name="observed_at" :value="old('observed_at',now())" />
                        </div>
                        <x-form-error name="observed_at"></x-form-error>

                    </div>
                </div>
                <div class="flex gap-2 mt-4">
                    <div class="w-full">
                    <x-form-field>
                        <div class="mt-2">
                            <x-form-label for="picture">Photo d'accompagnement</x-form-label>
                            <x-form-input type="file" name="picture" id="picture"></x-form-input>
                            <x-form-error name="picture"></x-form-error>
                        </div>
                    </x-form-field>
                    </div>
                 </div>

                 <div class="mt-6 flex items-center justify-start gap-x-6">
                    <a href="/mares" class="text-sm font-semibold leading-6 text-gray-900">Annuler</a>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Créer</button>
                </div>
            </div>





        </div>


    </form>



    @push('flatpickr')
        <x-flatpickr::script />
    @endpush

</x-layout>
