<x-layout>

    @push('flatpickr')
        <x-flatpickr::style />
    @endpush


    <x-slot:heading>
        Création
    </x-slot:heading>




        <script type="module">

        <x-map :markers="$markers"></x-map>

        var theMarker;

        map.on('click', function(e) {
            var latitude = e.latlng.lat.toString().substring(0, 15);
            var longitude = e.latlng.lng.toString().substring(0, 15);

            if (theMarker != undefined) {
                map.removeLayer(theMarker);
            };


            theMarker = L.marker([latitude, longitude], { 'draggable': true } ).addTo(map);


            theMarker.on('move', function(e) {
                latitude = e.latlng.lat.toString().substring(0, 15);
                longitude = e.latlng.lng.toString().substring(0, 15);

                document.getElementById('latitude').value = parseFloat(latitude).toFixed(7);
                document.getElementById('longitude').value = parseFloat(longitude).toFixed(7);


            });

            document.getElementById('latitude').value = parseFloat(latitude).toFixed(7);
            document.getElementById('longitude').value = parseFloat(longitude).toFixed(7);



        });

    </script>


    <div class="h-96" id="map"></div>

    <form method="POST" action="/mares" enctype="multipart/form-data">

        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Coordonnées</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form-field>
                            <x-form-label for="latitude">Latitude</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="text" name="latitude" id="latitude" placeholder="45.33445" :value="old('latitude')" required ></x-form-input>
                                <x-form-error name='latitude'></x-form-error>
                            </div>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="longitude">Longitude</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="text" name="longitude" id="longitude" placeholder="3.23445" :value="old('longitude')" required></x-form-input>
                                <x-form-error name='longitude'></x-form-error>
                            </div>
                        </x-form-field>
                </div>
            </div>
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Photographie</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form-field>
                            <x-flatpickr clearable :first-day-of-week="1" show-time name="observed_at" :value="old('observed_at')"/>
                            <x-form-error name='observed_at'></x-form-error>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="Photo">Photo</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="file" name="picture" id="picture"></x-form-input>
                                <x-form-error name='picture'></x-form-error>
                            </div>
                        </x-form-field>

                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a  href="/mares" class="text-sm font-semibold leading-6 text-gray-900">Annuler</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Créer</button>
        </div>
    </form>



@push('flatpickr')
    <x-flatpickr::script />
@endpush

</x-layout>
