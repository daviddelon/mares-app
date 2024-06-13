<x-layout>

    <x-slot:heading>
        Mares
    </x-slot:heading>


    <script type="module">

    <x-map :markers=$markers></x-map>

    </script>

    <div class="h-svh" id="map"></div>


    <div class="space-y-4">

        @foreach ($mares as $mare)
            <a href="mares/{{ $mare['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500 text-sm">
                    {{ $mare->user->name }}
                </div>
                <div>
                    Latitude : {{ $mare->latitude }}, Longitude : {{ $mare->longitude }}
                </div>
            </a>
        @endforeach



    </div>

    <div class="py-4">

        {{ $mares->links() }}

    </div>

</x-layout>
