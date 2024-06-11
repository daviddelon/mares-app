<x-layout>

    <x-slot:heading>
        Création
    </x-slot:heading>


    <script type="module">


        var map = L.map('map').setView([43.78, 3.76], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

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

    <form method="POST" action="/mares">

        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <x-form-field>
                            <x-form-label for="latitude">Latitude</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="text" name="latitude" id="latitude" placeholder="45.33445" required></x-form-input>
                                <x-form-error name='latitude'></x-form-error>
                            </div>
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="longitude">Longitude</x-form-label>
                            <div class="mt-2">
                                <x-form-input type="text" name="longitude" id="longitude" placeholder="3.23445" required></x-form-input>
                                <x-form-error name='longitude'></x-form-error>
                            </div>
                        </x-form-field>

                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a  href="/mares" class="text-sm font-semibold leading-6 text-gray-900">Annuler</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
        </div>
    </form>



</x-layout>
