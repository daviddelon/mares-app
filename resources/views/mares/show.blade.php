<x-layout>


    <x-slot:heading>
        Mare
    </x-slot:heading>

    {{ $mare->id}}  au coordonnées {{ $mare->latitude }}, {{  $mare->longitude }} créée par {{ $mare->user->name}}

    <ul>

    @foreach ( $mare->pictures as $picture)
        <li>
            Photographie par {{ $picture->user->name }} le {{ $picture->observed_at }}<img src="/storage/{{ $picture->path }}"></img>
        </li>

    @endforeach
    </ul>


    @auth
    <p class="mt-6">

        <x-button href="/mares/{{ $mare->id }}/edit">Modifier</x-button>

    </p>
    @endauth

</x-layout>
