<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../public/assets/logo.png">

    @vite(['resources/css/style.css', 'resources/css/components/header.css', 'resources/css/components/menu-mobile.css', 'resources/css/components/sidebar.css'])

    @yield('specific-styles')

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_package/apple-touch-icon.png') }}">

    <!-- Favicon para diferentes tamanhos -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_package/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_package/favicon-16x16.png') }}">

    <!-- Manifesto para PWA (Progressive Web App) -->
    <link rel="manifest" href="{{ asset('favicon_package/site.webmanifest') }}">

    <!-- Safari Pinned Tab Icon -->
    <link rel="mask-icon" href="{{ asset('favicon_package/safari-pinned-tab.svg') }}" color="#5bbad5">

    <!-- Meta tags para diferentes plataformas -->
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Fallback para navegadores mais antigos (favicon.ico) -->
    <link rel="shortcut icon" href="{{ asset('favicon_package/favicon.ico') }}">

    <script rel="preconnect" src="https://kit.fontawesome.com/638bd1bffb.js" crossorigin="anonymous"></script>
    <title>Enose Remote | {{ $title }}</title>
</head>

@php
    /* recuperando informações de usuário armazenadas em sessão, que serão utilizadas nas views */
    $userName = session('userName');
    $pathToProfileImage = session('pathToProfileImage');
    $isAdmin = session('isAdmin');
    $userID = Auth::id();
@endphp

<body>
    @include('components.header')

    @include('components.menu-mobile')

    <div class="contain">
        @include('components.sidebar')

        <main>
            @yield('content')
        </main>
    </div>

    @yield('modal')

    @vite('resources/js/index.js')

    @yield('specific-scripts')
</body>

</html>
