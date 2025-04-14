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
{{--     <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
 --}}    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush
    
    @stack('styles')
</head>

<body class="bg-[#F5FCFD] font-inter container  contents">
    @include('flash-message')
    @include('layout.navbar')

    <div class="mt-[60px] mx-[140px] mb-[140px]">
        @yield('content')
    </div>

    @livewireScripts
</body>
@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endpush
@stack('scripts')
</html>
