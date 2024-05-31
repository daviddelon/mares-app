<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mares</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/42/The_Frog_And_The_Water_Lily_%28125230279%29.jpeg/330px-The_Frog_And_The_Water_Lily_%28125230279%29.jpeg"
                                alt="Mares">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <!-- TODO add aria -->
                                <x-nav-link href="/" :active="request()->is('/')">Accueil</x-nav-link>
                                <x-nav-link href="/mares" :active="request()->is('mares*')">Mares</x-nav-link>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        @guest
                        <x-nav-link href="/login" :active="request()->is('login')">Se connecter</x-nav-link>
                        <x-nav-link href="/register" :active="request()->is('register')">Créer un compte</x-nav-link>
                        @endguest
                        @auth
                        <form method="POST" action="/logout">
                            @csrf
                            <x-form-button>{{ auth()->user()->name }} : Se déconnecter</x-form-button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>


            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <x-nav-link href="/" :active="request()->is('/')">Accueil</x-nav-link>
                    <x-nav-link href="/mares" :active="request()->is('mares*')">Mares</x-nav-link>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
                <x-button href="/mares/create">Nouvelle Mare</x-button>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
