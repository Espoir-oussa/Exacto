<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'IMUXT')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Assure-toi d'avoir Alpine.js et Tailwind CSS dans ton projet -->

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

        <!-- Sidebar -->
        @include('partials.sidebar')


        <!-- Wrapper contenu principal -->
        <div class="flex-1 flex flex-col">

            @include('partials.header')

            <h1 class="text-xl md:text-xl uppercase font-black text-gray-800 p-4 bg-gray-200 text-center md:text-left md:pl-10">
                @yield('page-title', '')
            </h1>

            <!-- Contenu principal -->
            <main class="flex-1 overflow-auto px-8 pt-8">
                <!-- Ton contenu ici -->
                @yield('content')
            </main>
        </div>

    </div>

</body>

</html>
