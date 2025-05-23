<!-- resources/views/components/mega-menu.blade.php -->
<div class="relative size-full" x-data="{
    isMenuOpen: false,
    isExpanded: false,
    toggleMenu() {
        this.isMenuOpen = !this.isMenuOpen;
        if (!this.isMenuOpen) {
            this.closeMenu();
        }
    },
    closeMenu() {
        this.isMenuOpen = false;
    },
    toggleExpand() {
        this.isExpanded = !this.isExpanded;
    }
}" @click.away="closeMenu()">
    <!-- Main Menu Button -->
    <button wire:click="toggleMenu" x-on:click="toggleMenu()" id="mega-menu-button"
        class="flex items-center text-accent bg-transparent rounded hover:cursor-pointer transition">
        <template x-if="$wire.isMenuOpenLivewire">
            <img class="w-[24px] h-[24px] opacity-100" src="{{ asset('icon/menu_aperto.svg') }}" alt="menu">
        </template>
        <template x-if="!$wire.isMenuOpenLivewire">
            <img class="w-[24px] h-[24px] opacity-100" src="{{ asset('icon/menu_chiuso.svg') }}" alt="menu">
        </template>
    </button>

    <template x-teleport=".megamenu">
        <div x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95" @click.away.stop="isExpanded = false"
            class="absolute left-0 right-0 w-full bg-white z-30 shadow">
            <div x-data="{
                selected: '{{ Route::currentRouteName() }}',
                isExpanded: false,
                toggleExpand() {
                    this.isExpanded = !this.isExpanded;
                }
            }" @click.away.stop="isExpanded = false" id="mega-menu-container"
                x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <div>

                    <div id="menu-content" class="p-7 mx-auto  w-full"
                        x-bind:style="isExpanded ? 'justify-self: center; max-width:1000px' : ''">
                        <div class="grid [grid-template-columns:repeat(auto-fit,_minmax(200px,_1fr))]  grid-rows-8 divide-y *:px-2 lg:grid-cols-8 lg:grid-rows-1 lg:divide-x lg:divide-y-0"
                            x-bind:class="{ 'list-item list-none': isExpanded }">
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52 "
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                '  border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex  h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/dash.svg" alt="Dashboard"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7] ml-[10px]  h-[32px] font-inter">
                                                        Dashboard
                                                    </p>
                                                </div>
                                            </a>
                                            <template
                                                x-for="item in [
                                                        { label: 'Dashboard', icon: '/icon/menu_exploded/dash.svg', route: '#' },
                                                    ]"
                                                :key="item.label">
                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100 ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname === window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52 "
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                ' border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">


                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/progetti.svg" alt="Progetto"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7] ml-[10px]  h-[32px] font-inter">
                                                        Progetto
                                                    </p>
                                                </div>
                                            </a>



                                            <template
                                                x-for="item in [
                                                { label: 'Progetti', icon: '/icon/menu_exploded/progetti.svg', route: '{{ route('projects.project') }}' },
                                                { label: 'Pianificazione', icon: '/icon/menu_exploded/pianificazione.svg', route: '#' },
                                                { label: 'Archiviati', icon: '/icon/menu_exploded/progetti archiviati.svg', route: '#' }
                                            ]"
                                                :key="item.label">

                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100  ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname === window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52"
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                '  border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">

                                            <!-- Main Label -->
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex  h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/operazioni e risorse.svg"
                                                        alt="Operazioni & risorse"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7]  ml-[10px]  font-inter">
                                                        Operazioni & risorse
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Expanded View Sub Items -->
                                            <template
                                                x-for="item in [
                                                { label: 'Magazzino', icon: '/icon/menu_exploded/magazzino.svg', route: '#' },
                                                { label: 'Acquisti', icon: '/icon/menu_exploded/acquisti.svg', route: '#' },
                                                { label: 'Pianificazione', icon: '/icon/menu_exploded/pianificazione.svg', route: '#' },
                                                { label: 'Codici a barre', icon: '/icon/menu_exploded/codici a barre.svg', route: '#' }
                                            ]"
                                                :key="item.label">

                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100 ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname === window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] ml-[10px] font-inter">
                                        <div class="menu-item w-max-52 "
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                '  border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">

                                            <!-- Main Label -->
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/dipendenti.svg" alt="Dipendenti"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7] ml-[10px]  h-[32px] font-inter">
                                                        Dipendenti
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Expanded View Sub Items -->
                                            <template
                                                x-for="item in [
                                                                { label: 'Anagrafica', icon: '/icon/menu_exploded/anagrafica dipendenti.svg', route: '#' },
                                                                { label: 'Presenze', icon: '/icon/menu_exploded/presenze dipendenti.svg', route: '#' },
                                                                { label: 'Ferie', icon: '/icon/menu_exploded/ferie dipendenti.svg', route: '#' },
                                                                { label: 'Rimborsi Archiviati', icon: '/icon/menu_exploded/rimborsi dipendenti.svg', route: '#' },
                                                                { label: 'Richieste', icon: '/icon/menu_exploded/richieste dipendenti.svg', route: '#' },
                                                                { label: 'Selezione personale', icon: '/icon/menu_exploded/selezione personale.svg', route: '#' }
                                                            ]"
                                                :key="item.label">
                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100 ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname === window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52"
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                ' border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">

                                            <!-- Main Label -->
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex  h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/amministrazione.svg" alt="Amministrazione"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7] ml-[10px]  h-[32px] font-inter">
                                                        Amministrazione
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Expanded View Sub Items -->
                                            <template
                                                x-for="item in [
                                                            { label: 'Contabilità', icon: '/icon/menu_exploded/contabilità.svg', route: '#' },
                                                     
                                                        ]"
                                                :key="item.label">
                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100 ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname === window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52 "
                                            :class="isExpanded ? '' : '  border-gray-200'"
                                            x-bind:style="isExpanded ? 'height: 0px;' : ''">

                                            <!-- Collapsed View -->
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex  h-[17px]" x-bind:hidden="isExpanded">
                                                    <img src="/icon/menu/documenti.svg" alt="Documenti"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-light text-[15px] leading-[19px] tracking-[0px] text-[#C7C7C7] opacity-100 text-left font-inter  ml-[10px] ">
                                                        Documenti
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52 "
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                ' border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">

                                            <!-- Main Label -->
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex  h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/CRM.svg" alt="CRM"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7] ml-[10px]  h-[32px] font-inter">
                                                        CRM
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Expanded View Items -->
                                            <template
                                                x-for="item in [
                                                                    { label: 'Lead', icon: '/icon/menu_exploded/lead.svg', route: '{{ route('crm.client.index', 'lead') }}' },
                                                                    { label: 'Contatti', icon: '/icon/menu_exploded/contatti.svg', route: '{{ route('crm.client.index', 'contatto') }}' },
                                                                    { label: 'Clienti', icon: '/icon/menu_exploded/clienti.svg', route: '{{ route('crm.client.index', 'cliente') }}' },
                                                                    { label: 'Preventivi', icon: '/icon/menu_exploded/vendite.svg', route: '{{ route('crm.quotes.index', 'preventivi') }}' },
                                                                    { label: 'Servizi & prezzi', icon: '/icon/menu_exploded/servizi e prezzi.svg', route: '{{ route('crm.products.index', 'servizi') }}' }
                                                            ]"
                                                :key="item.label">

                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100  ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname ===
                                                                window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div class="  ">
                                <ul>
                                    <li class="font-thin text-[15px] text-[#C7C7C7] lg:ml-[10px]  font-inter">
                                        <div class="menu-item w-max-52 "
                                            :class="isExpanded ? 'h-30 border-b-2 border-gray-200' :
                                                '  border-gray-200'"
                                            :style="isExpanded ? 'display: flex; justify-content:start;' : ''">

                                            <!-- Main Label -->
                                            <a href="#" class="block group lg:ml-2.5 h-[32px]">
                                                <div class="flex  h-[17px]" x-show="!isExpanded">
                                                    <img src="/icon/menu/CRM.svg" alt="Gestione"
                                                        class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                                    <p
                                                        class="font-thin text-[15px] text-[#C7C7C7] ml-[10px]  h-[32px] font-inter">
                                                        Gestione
                                                    </p>
                                                </div>
                                            </a>

                                            <!-- Expanded View Items -->
                                            <template
                                                x-for="item in [
                                                                { label: 'Attività', icon: '/icon/menu_exploded/pianificazione.svg', route: '#' },
                                                                { label: 'Calendario', icon: '/icon/menu_exploded/mappa.svg', route: '#' },
                                                    
                                                        ]"
                                                :key="item.label">

                                                <div class="menu-item-inside grid   "
                                                    :style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">

                                                    <!-- Icon -->
                                                    <a :href="item.route" class="block group lg:ml-2.5">
                                                        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
                                                            <img x-show="isExpanded" :src="item.icon"
                                                                :alt="item.label"
                                                                class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                                        </div>
                                                    </a>

                                                    <!-- Label with active style -->
                                                    <a :href="item.route"
                                                        class="relative group font-light text-[15px] leading-[19px] opacity-100  ml-[8px] h-[32px]"
                                                        :class="{
                                                            'pl-4': !isExpanded,
                                                            'text-[#10BDD4]': new URL(item.route, window.location
                                                                    .origin)
                                                                .pathname ===
                                                                window.location.pathname,
                                                            'text-[#B0B0B0] group-hover:text-[#10BDD4]': new URL(item
                                                                    .route, window
                                                                    .location.origin).pathname !== window.location
                                                                .pathname
                                                        }">
                                                        <span x-text="item.label"></span>
                                                        <span
                                                            class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                                    </a>

                                                </div>
                                            </template>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>
                        <div class="text-center">
                            <button id="expand-button" @click.stop="toggleExpand()"
                                class="absolute w-[40px] h-[40px] ml-[105px]  rounded-full bg-[#10BDD4] hover:bg-cyan-800 hover:cursor-pointer flex items-center justify-center focus:outline-none transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    viewBox="0 0 512 512" fill="white">
                                    <!-- Arrows pointing inward (shown when not expanded) -->
                                    <g id="arrows-inward" x-show="!isExpanded">
                                        <path
                                            d="M509.081,3.193c-4.16-4.16-10.88-4.16-15.04,0l-195.2,195.2V75.086c0-5.333-3.84-10.133-9.067-10.88
                                        c-6.613-0.96-12.267,4.16-12.267,10.56V224.1c0,5.867,4.8,10.667,10.667,10.667h149.013c5.333,0,10.133-3.84,10.88-9.067
                                        c0.96-6.613-4.16-12.267-10.56-12.267H313.881l195.2-195.093C513.241,14.18,513.241,7.353,509.081,3.193z" />
                                        <path d="M224.174,277.433H75.161c-5.333,0-10.133,3.84-10.88,9.067c-0.96,6.613,4.16,12.267,10.56,12.267h123.627L3.268,493.86
                                        c-4.267,4.053-4.373,10.88-0.213,15.04c4.16,4.16,10.88,4.373,15.04,0.213c0.107-0.107,0.213-0.213,0.213-0.213l195.2-195.093
                                        v123.2c0,5.333,3.84,10.133,9.067,10.88c6.613,0.96,12.267-4.16,12.267-10.56V288.1
                                        C234.841,282.233,230.041,277.433,224.174,277.433z" />
                                    </g>
                                    <!-- Arrows pointing outward (shown when expanded) -->
                                    <g id="arrows-outward" x-show="isExpanded">
                                        <path d="M511.179,6.592c-1.647-3.986-5.533-6.587-9.845-6.592H362.667C356.776,0,352,4.776,352,10.667
                                        c0,5.891,4.776,10.667,10.667,10.667h112.917L291.125,205.792c-4.237,4.093-4.354,10.845-0.262,15.083s10.845,4.354,15.083,0.262
                                        c0.089-0.086,0.176-0.173,0.262-0.262L490.667,36.416v112.917c0,5.891,4.776,10.667,10.667,10.667S512,155.224,512,149.333
                                        V10.667C511.996,9.268,511.717,7.883,511.179,6.592z" />
                                        <path
                                            d="M205.792,291.125L21.333,475.584V362.667c0-5.891-4.776-10.667-10.667-10.667C4.776,352,0,356.776,0,362.667v138.667
                                        C0,507.224,4.776,512,10.667,512h138.667c5.891,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667H36.416
                                        l184.459-184.459c4.093-4.237,3.976-10.99-0.262-15.083C216.479,287.133,209.926,287.133,205.792,291.125z" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hidden Extra Content (Will be shown when expanded) -->
                <div id="expanded-content" class="overflow-x-auto" x-show="isExpanded">
                    <div class="flex space-x-6 min-w-max">
                        <!-- Extra Menu Item content -->
                    </div>
                </div>

        
            </div>
        </div>
</div>
</template>
</div>
</div>
