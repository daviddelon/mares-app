<x-layout>


    <x-slot:heading>
        Mare
    </x-slot:heading>

    {{ $mare->id}}  au coordonnées {{ $mare->latitude }}, {{  $mare->longitude }} observée par {{ $mare->user->name}} avec les tags :

    <ul>
    @foreach ($mare->tags as $tag)

        <li>
        {{  $tag->name }}
        </li>

    @endforeach
    </ul>

    @auth
    <p class="mt-6">

        <x-button href="/mares/{{ $mare->id }}/edit">Modifier</x-button>

    </p>
    @endauth

</x-layout>
