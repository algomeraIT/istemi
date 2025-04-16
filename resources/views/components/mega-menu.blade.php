<div class="relative w-[270px]"
    x-data="{
        isMenuOpen: false,
        isExpanded: false,
        selected: '{{ Route::currentRouteName() }}',
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
            if (!this.isMenuOpen) {
                // When closing, collapse expanded content too.
                this.isExpanded = false;
            }
        },
        closeMenu() {
            this.isMenuOpen = false;
            this.isExpanded = false;
        },
        toggleExpand() {
            this.isExpanded = !this.isExpanded;
        }
    }"
    @click.away="closeMenu()">
    
    <!-- Main Menu Button -->
    <button id="mega-menu-button"
        wire:click="toggleMenu"
        x-on:click="toggleMenu()"
        class="flex items-center text-accent bg-transparent rounded hover:cursor-pointer transition w-[40px] h-[40px] ml-[105px] mb-[65px]">
        <!-- Use Livewire’s state for button icon if needed -->
        <template x-if="isMenuOpen">
            <img src="{{ asset('icon/menu_aperto.svg') }}" alt="menu">
        </template>
        <template x-if="!isMenuOpen">
            <img src="{{ asset('icon/menu_chiuso.svg') }}" alt="menu">
        </template>
    </button>

    <!-- Mega Menu Container -->
    <div id="mega-menu-container"
        class="absolute bg-white transition-all duration-300 overflow-hidden border-gray-300 w-[1900px] cursor-pointer select-none z-10 border-b-0"
        x-show="isMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        x-bind:style="isExpanded ? 'height: 768px' : 'height: 420px'">
        
        <div class="overflow-auto">
            <!-- Initial Menu Content (Horizontal Layout) -->
            <div id="menu-content" class="flex flex-col md:flex-row md:space-x-6 justify-center mt-[47px]">
                <div class="menu-rows flex items-start">
                
                    <!-- Example of a top-level simple menu item component -->
                    <x-mega-menu-item 
                        identifier="dashboard"
                        label="Dashboard"
                        :route="'#'" 
                        :collapsedIcon="asset('/icon/dash.svg')"
                        :activeIcon="asset('/icon/dash-blue.svg')"
                        :expandedIcon="asset('/icon/menu_exploded/dash-color.svg')"
                    />

                    <!-- Example of a menu group with sub-items -->
                    <x-mega-menu-group label="Progetto" :baseIcon="asset('/icon/menu/progetti.svg')">
                        <!-- Define sub items as a slot -->
                        <x-slot name="subItems">
                            <x-mega-menu-sub-item 
                                identifier="projects.project"
                                label="Progetti"
                                :route="route('projects.project')"
                                :collapsedIcon="asset('/icon/dash.svg')"
                                :expandedIcon="asset('/icon/menu_exploded/progetti-color.svg')"
                            />
                            <x-mega-menu-sub-item 
                                label="Pianificazione"
                                :route="'#'"
                                :collapsedIcon="asset('/icon/menu_exploded/pianificazione.svg')"
                                :expandedIcon="asset('/icon/menu_exploded/pianificazione.svg')"
                            />
                            <!-- Add more sub-items as needed -->
                        </x-slot>
                    </x-mega-menu-group>
                    
                    <!-- Add other top-level menu items or groups similarly -->
                    
                </div>
            </div>

            <!-- Hidden Extra Content for Expanded view -->
            <div id="expanded-content" class="overflow-x-auto" x-show="isExpanded">
                <div class="flex space-x-6 min-w-max">
                    <!-- Extra menu content when expanded -->
                </div>
            </div>

            <!-- Expand Button at the Bottom -->
            <div class="text-center">
                <button id="expand-button"
                    @click="toggleExpand()"
                    class="w-[40px] h-[40px] ml-[105px] fixed rounded-full bg-[#10BDD4] hover:bg-cyan-800 hover:cursor-pointer flex items-center justify-center focus:outline-none transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512" fill="white">
                        <!-- Arrows pointing inward (shown when not expanded) -->
                        <g x-show="!isExpanded">
                            <path d="M509.081,3.193c-4.16-4.16-10.88-4.16-15.04,0l-195.2,195.2V75.086c0-5.333-3.84-10.133-9.067-10.88
                                c-6.613-0.96-12.267,4.16-12.267,10.56V224.1c0,5.867,4.8,10.667,10.667,10.667h149.013c5.333,0,10.133-3.84,10.88-9.067
                                c0.96-6.613-4.16-12.267-10.56-12.267H313.881l195.2-195.093C513.241,14.18,513.241,7.353,509.081,3.193z"/>
                            <path d="M224.174,277.433H75.161c-5.333,0-10.133,3.84-10.88,9.067c-0.96,6.613,4.16,12.267,10.56,12.267h123.627L3.268,493.86
                                c-4.267,4.053-4.373,10.88-0.213,15.04c4.16,4.16,10.88,4.373,15.04,0.213c0.107-0.107,0.213-0.213,0.213-0.213l195.2-195.093
                                v123.2c0,5.333,3.84,10.133,9.067,10.88c6.613,0.96,12.267-4.16,12.267-10.56V288.1
                                C234.841,282.233,230.041,277.433,224.174,277.433z"/>
                        </g>
                        <!-- Arrows pointing outward (shown when expanded) -->
                        <g x-show="isExpanded">
                            <path d="M511.179,6.592c-1.647-3.986-5.533-6.587-9.845-6.592H362.667C356.776,0,352,4.776,352,10.667
                                c0,5.891,4.776,10.667,10.667,10.667h112.917L291.125,205.792c-4.237,4.093-4.354,10.845-0.262,15.083
                                s10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262L490.667,36.416v112.917c0,5.891,4.776,10.667,10.667,10.667
                                S512,155.224,512,149.333V10.667C511.996,9.268,511.717,7.883,511.179,6.592z"/>
                            <path d="M205.792,291.125L21.333,475.584V362.667c0-5.891-4.776-10.667-10.667-10.667C4.776,352,0,356.776,0,362.667v138.667
                                C0,507.224,4.776,512,10.667,512h138.667c5.891,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667H36.416
                                l184.459-184.459c4.093-4.237,3.976-10.99-0.262-15.083C216.479,287.133,209.926,287.133,205.792,291.125z"/>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>