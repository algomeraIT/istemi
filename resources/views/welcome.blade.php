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
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
  @vite('resources/css/app.css')
  
    </head>
    <body >
    {{-- colored banner --}}
      <div class="w-full px-4 md:px-16 lg:px-40 absolute">
      <div 
        class="bg-cyan-100 w-full h-60 mx-auto">
      </div>
    </div>

  <div class="bg-white min-h-screen flex items-center justify-center">
        {{-- Login Form --}}
        <div class="bg-white w-md h-[40rem] shadow-[0px_0px_20px_3px_#cbd5e0] px-8  p-8  relative z-10">
            {{-- Logo --}}
            <div class="flex justify-start mb-6 w-40">
                <img class="w-40" src="{{ asset('icon/logo.svg') }}" alt="Logo">
            </div>

            {{-- Welcome Message --}}
            <div class=" p-3 mb-6">     
            <h2 class=" text-left text-xl font-bold  text-gray-800">Benvenuto!</h2>
            <p class="text-left text-gray-400 font-normal">Accedi al tuo account</p>
            </div>
       
            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email Input --}}
                <div>

    <label for="email" class="block text-gray-400 text-sm font-light mb-2">
                        E-mail
                    </label>
<div class="relative">
  <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
 <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-cyan-400 dark:text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="12" cy="12" r="4"/>
  <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"/>
</svg>
  </div>
  <input type="text" id="input-group-1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="esempio@sistemi.com">
</div>
<label for="website-admin" class="block text-gray-400 text-sm font-light mb-2">Password</label>
<div class="relative">
  <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-cyan-400 dark:text-gray-400" viewBox="0 0 512 512" fill="currentColor">
  <path d="M229.674 441.415c-36.939 36.94-97.043 36.939-133.982 0-37.026-37.023-37.029-96.953 0-133.98 36.938-36.939 97.043-36.94 133.98 0 36.937 36.957 36.937 96.961 0 133.98z"/>
  <path d="M480.71 56.397L430.596 6.283c-8.376-8.377-21.958-8.377-30.335 0-8.377 8.377-8.377 21.959 0 30.335l34.948 34.947-12.46 12.46-14.177-14.177c-8.374-8.377-21.958-8.377-30.335 0-8.377 8.376-8.377 21.958 0 30.335l14.177 14.177-12.46 12.46-34.947-34.947c-8.376-8.376-21.958-8.376-30.335 0-8.377 8.377-8.377 21.958 0 30.337l34.947 34.947L243.653 263.122c-53.793-39.18-129.789-34.528-178.295 13.978-53.792 53.79-53.797 140.854 0 194.653 53.663 53.663 140.985 53.667 194.652-0.001 48.505-48.506 53.157-124.502 13.978-178.295L480.713 86.733c8.368-8.371 8.374-21.961-0.003-30.336z"/>
</svg>
  </div>
  <input    type="password"   name="password" id="password"  required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

  
</div>
   <div class="mb-6">
        <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:text-cyan-400">
            Password dimenticata?
        </a>
    </div>
           

                {{-- Login Button --}}
                <div>
                    <button
                        type="submit"
                        class="w-2 bg-white text-cyan-200 py-2 px-4">
                        Accedi
                    </button>
                </div>

                     <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-400">
                            Resta connesso
                        </label>
                    </div>
                </div>
            </form>
               </div>
        </div>
    </div>
    </body>
</html>
