<section class="border-b border-b-gray-200 py-10">
    <nav class="container mx-auto px-4 bg-white flex items-center z-[1] lg:justify-between">
        <div class="w-auto mr-2 lg:w-90">
            @livewire('collapsible-menu')
        </div>
        <div class="mr-auto lg:mr-0">
            <img class="w-24 mt-1.5" src="{{ asset('icon/logo.svg') }}" alt="Logo">
        </div>
        <div class="w-auto flex items-center space-x-12 lg:w-90">
            <div class="hidden items-center gap-6 lg:flex">
                <flux:icon.chat-bubble-bottom-center variant="solid" class="text-[#10BDD4]"/>
                <flux:icon.presentation-chart-bar variant="solid" class="text-[#10BDD4]"/>
                <flux:icon.bell variant="solid" class="text-[#10BDD4]"/>
            </div>
            <flux:dropdown align="end">
                <button class="min-w-36 flex items-center gap-2.5 px-1 py-px rounded text-left text-sm hover:bg-gray-50">
                    <div class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-full">
                        <div class="flex h-full w-full items-center justify-center rounded-full bg-[#F5FCFD] text-[#10BDD4] dark:bg-neutral-700 dark:text-white">
                            <flux:icon.user variant="micro"/>
                        </div>
                    </div>

                    <div class="grid flex-1 text-left text-sm leading-tight">
                        <flux:text variant="strong" class="truncate">{{ auth()->user()->full_name }}</flux:text>
                        <flux:text class="text-xs">{{ auth()->user()->role }}</flux:text>
                    </div>
                    <flux:icon.chevron-down variant="micro" class="text-neutral-400"/>
                </button>
                <flux:navmenu class="max-w-[12rem]">
                    <flux:navmenu.item href="{{ route('change-password') }}">Cambia password</flux:navmenu.item>
                    <flux:navmenu.separator/>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:navmenu.item type="submit" variant="danger">Logout</flux:navmenu.item>
                    </form>
                </flux:navmenu>
            </flux:dropdown>
        </div>
    </nav>


    {{--    <nav class="w-full h-[100px] bg-white border-b border-gray-200 shadow-sm opacity-100 flex justify-between items-center z-[1]">--}}
    {{--        <div class="w-2/6">--}}
    {{--             @livewire('collapsible-menu')--}}
    {{--             <x-mega-menu />--}}
    {{--        </div>--}}
    {{--        <div class="flex text-center justify-center mt-5 mb-8 w-2/6">--}}
    {{--            <img class="absolute top-8  w-24 h-9 opacity-100 " src="{{ asset('icon/logo.svg') }}" alt="Logo">--}}
    {{--        </div>--}}

    {{--        <!-- Right: Icons and User Info -->--}}
    {{--        <div class="flex space-x-3 w-2/6 justify-center">--}}
    {{--            <!-- Messages Icon -->--}}
    {{--            <button class="text-gray-600 focus:outline-none pr-10">--}}
    {{--                <image alt="chat" src="{{ asset('icon/navbar/chatbox-ellipses-outline.svg') }}" />--}}
    {{--            </button>--}}

    {{--            <!-- Generic Icon (Example) -->--}}
    {{--            <button class="text-gray-600 focus:outline-none pr-10">--}}
    {{--                <image alt="chat" src="{{ asset('icon/navbar/easel-outline.svg') }}" />--}}

    {{--            </button>--}}

    {{--            <!-- Notifications Icon -->--}}
    {{--            <button class="text-gray-600 focus:outline-none pr-10">--}}
    {{--                <image alt="notifiche" src="{{ asset('icon/navbar/notifications-outline.svg') }}" />--}}

    {{--            </button>--}}

    {{--            <!-- User Profile (Icon + Name + Role) -->--}}


    {{--            <div class="flex items-center space-x-2 ml-5 ">--}}
    {{--                <button id="userDropdownButton"--}}
    {{--                    class="flex items-center space-x-2 focus:outline-none  hover:cursor-pointer">--}}
    {{--                    @if (isset(Auth::user()->profile_photo))--}}
    {{--                    <img src="{{ Auth::user()->profile_photo_url }}" alt="User" class="w-8 h-8 rounded-full">--}}
    {{--                    @else--}}
    {{--                    <div class="w-10 h-10 bg-[#F5FCFD] rounded-4xl flex">--}}
    {{--                        <image alt="utente" class="w-5 h-4.5 m-2.5" src="{{ asset('icon/navbar/user.svg') }}" />--}}
    {{--                    </div>--}}

    {{--                    @endif--}}
    {{--                    <div class="flex flex-col items-start ml-5">--}}
    {{--                        <span class="text-4  font-normal text-[#232323] text-left opacity-100 font-inter">--}}
    {{--                            {{ Auth::user()->name . ' ' . Auth::user()->last_name}} </span>--}}
    {{--                        <span class="text-4 font-light text-[#232323] tracking-[0px] text-left opacity-100 font-inter">--}}
    {{--                            {{ Auth::user()->role }}</span>--}}
    {{--                    </div>--}}

    {{--                </button>--}}

    {{--                <!-- Dropdown -->--}}
    {{--                <div id="userDropdownMenu"--}}
    {{--                    class="hidden absolute right-0 mt-28 w-48 bg-white rounded-md shadow-lg z-50">--}}

    {{--                    <a href="{{ route('change-password') }}"--}}
    {{--                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-cyan-100">--}}
    {{--                        Cambia Password--}}
    {{--                    </a>--}}
    {{--                    <form method="POST" action="{{ route('logout') }}">--}}
    {{--                        @csrf--}}
    {{--                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-cyan-100">--}}
    {{--                            Logout--}}
    {{--                        </button>--}}
    {{--                    </form>--}}
    {{--                </div>--}}


    {{--            </div>--}}
    {{--    </nav>--}}
</section>