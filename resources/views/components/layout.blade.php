</html>
<!doctype html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mares des Garrigues</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('flatpickr')

</head>

<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-white py-5 px-6 flex flex-wrap justify-between items-center">

             <a href="#" class="flex-1">
                <img class="inline h-7" src="/images/mare_garrigue.jpg" alt="Une mare de la Garrigue" />
              </a>
              <ul class="order-last flex-[100%] mt-4 md:order-none md:flex-auto md:mt-0 inline-block mx-5">
                <li class="inline-block mx-5">
                    <x-nav-link href="/" :active="request()->is('/')">Accueil</x-nav-link>
                </li>
                <li class="inline-block mx-5">
                    <x-nav-link href="/mares" :active="request()->is('mares*')">Carte</x-nav-link>
                </li>
              </ul>

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

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>

                @if (! request()->is('mares/create'))
                    <x-button href="/mares/create">Nouvelle Mare</x-button>
                @endif
            </div>
        </header>

        <main>
            <div class="mx-auto py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
