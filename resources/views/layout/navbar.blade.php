<section class="">
    <nav class="fixed top-0 left-0 w-[1920px] h-[100px] bg-white opacity-100 flex justify-between items-center z-[1]">
        @livewire('collapsible-menu')

        <div class="flex text-center justify-center mt-[25px] mb-[32px] ml-80">
            <img class="absolute top-[32px]  w-[100px] h-[36px] opacity-100 " src="{{ asset('icon/logo.svg') }}"
                alt="Logo">
        </div>

        <!-- Right: Icons and User Info -->
        <div class="flex items-center space-x-6 w-[600px]">
            <!-- Messages Icon -->
            <button class="text-gray-600 focus:outline-none pr-[30px]">
                <image alt="chat" src="{{ asset('icon/navbar/chatbox-ellipses-outline.svg') }}" />
            </button>

            <!-- Generic Icon (Example) -->
            <button class="text-gray-600 focus:outline-none pr-[30px]">
                <image alt="chat" src="{{ asset('icon/navbar/easel-outline.svg') }}" />

            </button>

            <!-- Notifications Icon -->
            <button class="text-gray-600 focus:outline-none pr-[90px]">
                <image alt="notifiche" src="{{ asset('icon/navbar/notifications-outline.svg') }}" />

            </button>

            <!-- User Profile (Icon + Name + Role) -->


            <div class="flex items-center space-x-2 ">
                <button id="userDropdownButton"
                    class="flex items-center space-x-2 focus:outline-none  hover:cursor-pointer">
                    @if (isset(Auth::user()->profile_photo))
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="User" class="w-8 h-8 rounded-full">
                    @else
                    <image alt="utente" src="{{ asset('icon/navbar/user.svg') }}" />

                    @endif
                    <div class="flex flex-col items-start ml-[20px]">
                        <span
                            class="text-[18px] leading-[21px] font-normal text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                            {{ Auth::user()->name . ' ' . Auth::user()->last_name}} </span>
                        <span
                            class="text-[17px] leading-[20px] font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">
                            {{ Auth::user()->role }}</span>
                    </div>

                </button>

                <!-- Dropdown -->
                <div id="userDropdownMenu"
                    class="hidden absolute right-0 mt-28 w-48 bg-white rounded-md shadow-lg z-50">

                    <a href="{{ route('change-password') }}"
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-cyan-100">
                        Cambia Password
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-cyan-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
    </nav>
</section>


<script src="{{ asset('js/navbar.js') }}"></script>