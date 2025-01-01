<!doctype html>
<html lang="en" class="h-full bg-white-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mares des Garrigues</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('flatpickr')

</head>

<body class="min-h-full">
    <nav class="py-5 px-6 flex justify-between items-center">

            <a href="/" class="flex-1">
                Mares des Garrigues
            </a>
            <span class="flex-1 text-right">
                @guest
                    <form class="my-1" method="GET" action="/login">
                        @csrf
                        <x-form-button>S'identifier</x-form-button>
                    </form>
                @endguest

                @auth
                    <form class="my-1" method="POST" action="/logout">
                        @csrf
                        <x-form-button>Se déconnecter</x-form-button>
                    </form>
                @endauth
            </span>



    </nav>

    <header>
        <div class="mx-auto">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>

            @auth
                @if (! request()->is('mares/create'))
                    <x-button href="/mares/create">Nouvelle Mare</x-button>
                @endif
            @endauth

        </div>
    </header>

    <main>
        <div class="mx-auto py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
