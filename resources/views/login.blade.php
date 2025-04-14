<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <link rel="icon" href="{{ asset('icon/logo.svg') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') . ' Login' }}</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')

</head>

<body>
  {{-- colored banner --}}
  <div class="w-full  absolute">
    <div class="bg-[#D1FAFF] w-full h-[300px] mx-auto">
    </div>
  </div>

  <div class="bg-[#F5FCFD] min-h-screen font-inter flex items-center justify-center shadow-[0_10px_15px_30px_rgb(0_0_0/0.1),0_4px_6px_-4px_rgb(0_0_0/0.1)] ">
    <div class="w-[533px] h-[778px] mt-[150px]   relative z-10 bg-white shadow-[0px_0px_39px_1px_rgb(0_88_95_/_27%)] opacity-100">
      {{-- Logo --}}
      <div class="flex justify-start ml-[50px] mt-[50px]">
        <img class="w-[200px] h-[73px]" src="{{ asset('icon/logo.svg') }}" alt="Logo">
      </div>

      {{-- Login Form --}}
      @livewire('login-form')

    </div>
  </div>
  </div>
</body>

</html>