@extends('layout.main')
@include('flash-message')
<div>
    @section('content')
        <div class=" p-4 mt-14">
            <div class=" p-6 ">
                <h2 class="text-xl font-semibold mb-4">Cambia Password</h2>

                <form wire:submit.defer="updatePassword" method="POST">
                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Password
                            Corrente</label>
                        <input type="password" id="current_password" wire:model="current_password"
                            class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Nuova Password</label>
                        <input type="password" id="new_password" wire:model="new_password"
                            class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Conferma
                            Nuova Password</label>
                        <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation"
                            class="mb-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-cyan-500 text-white hover:bg-cyan-700 active:bg-cyan-500 cursor-pointer">
                        Modifica Password
                    </button>

                    <!-- Back Button -->
                    <a href="{{ route('dashboard') }}" class="bg-white text-gray-500 cursor-pointer">
                        Indietro
                    </a>
                </form>
            </div>
        </div>
    @endsection
</div>


