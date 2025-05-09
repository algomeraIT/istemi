<nav class="px-10 lg:px-[105px] px-4 bg-white border-b border-b-gray-200 py-8 flex items-center z-[1] lg:justify-between">
    <div class="w-auto ml-4 lg:w-90">
        @livewire('collapsible-menu')
    </div>

    <div class="mr-auto lg:mr-0 ml-4 lg:ml-0">
        <img class="w-24 mt-1 lg:mt-0" src="{{ asset('icon/logo.svg') }}" alt="Logo">
    </div>
    
    <div class="w-auto mr-4 flex items-center justify-between space-x-12 lg:w-90">
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
                    <flux:text variant="strong" class="truncate">{{ auth()->user()?->full_name }}</flux:text>
                    <flux:text class="text-xs">{{ auth()->user()?->role }}</flux:text>
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
