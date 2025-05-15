<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="{{ asset('icon/logo.svg') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body>
    @include('flash-message')
    @include('layout.navbar')

    <div class="megamenu"></div>

    <div class="h-[calc(100vh-103px)] bg-[#F5FCFD] py-12">
        @yield('content')

        <main class="h-full grid grid-cols-12 gap-[30px] mx-10 lg:mx-[105px]">
            <div class="col-span-12">
                {{ $slot ?? null }}
            </div>
        </main>
    </div>

    @fluxScripts
    @livewire('wire-elements-modal')

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    @stack('scripts')
    
    @persist('toast')
        <flux:toast position="top right" />
    @endpersist
</body>

</html>
