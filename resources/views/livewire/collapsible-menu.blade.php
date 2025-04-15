<!-- resources/views/components/mega-menu.blade.php -->
<div class="relative w-[270px]" x-data="{
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
        class="flex items-center text-accent bg-transparent rounded hover:cursor-pointer transition w-[40px] h-[40px] ml-[105px] mb-[65px]">
        <template x-if="$wire.isMenuOpenLivewire">
            <img class="absolute top-[37px] left-[113px] w-[24px] h-[24px] opacity-100"
                src="{{ asset('icon/menu_aperto.svg') }}" alt="menu">
        </template>
        <template x-if="!$wire.isMenuOpenLivewire">
            <img class="absolute top-[37px] left-[113px] w-[24px] h-[24px] opacity-100"
                src="{{ asset('icon/menu_chiuso.svg') }}" alt="menu">
        </template>
    </button>

    <!-- Mega Menu Container -->
    <div x-data="{
        selected: '{{ Route::currentRouteName() }}',
        isExpanded: false,
        toggleExpand() {
            this.isExpanded = !this.isExpanded;
        }
    }" @click.away="isExpanded = false" id="mega-menu-container"
        class="absolute bg-white transition-all duration-300 overflow-hidden border-b border-gray-300 w-[1900px] cursor-pointer select-none z-10"
        x-show="isMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        x-bind:style="isExpanded ? 'height: 768px' : 'height: 420px'">
        <div class="">
            <!-- Initial Menu Content (Horizontal Layout) -->
            <div id="menu-content" class="flex flex-col md:flex-row md:space-x-6  justify-center mt-[47px]"
                x-bind:style="isExpanded ? 'justify-self: center; height: 700px;' : ''">
                <div class="menu-rows flex items-start w-max-[1980px]"
                    x-bind:class="{ 'list-item list-none': isExpanded }">

                    <!-- Menu Item 1 -->
                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88'"
                        :style="isExpanded ? 'padding: 0; justify-items: baseline;' : 'display:flex;'"
                        @click="selected = 'dashboard'">
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div>
                                <img x-show="!isExpanded"
                                    :src="selected === 'dashboard' ? '/icon/dash-blue.svg' : '/icon/dash.svg'"
                                    alt="Dashboard"
                                    class="w-[12px] h-[13px] mt-[4px] object-cover transition duration-300 group-hover:scale-105" />
                                <img x-show="isExpanded"
                                    :src="selected === 'dashboard' ? '/icon/menu_exploded/dash - color.svg' : '/icon/dash.svg'"
                                    alt="Dashboard"
                                    class="w-[20px] expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]" />
                            </div>
                        </a>
                        <a href="#"
                            :class="[
                                isExpanded ? 'mt-5' : '',
                                selected === 'dashboard' ? 'text-[#10BDD4]' :
                                'text-[#B0B0B0] group-hover:text-[#10BDD4]'
                            ]"
                            class="relative group font-light text-[15px] leading-[19px] opacity-100 w-[100px] ml-[8px] h-[32px] whitespace-pre-line">
                            Dashboard
                            <span
                                class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                        </a>
                    </div>

                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
                        :style="isExpanded ? 'display: flex;' : ''">

                        <!-- Main Label -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-show="!isExpanded">
                                <img src="/icon/menu/progetti.svg" alt="Progetto"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p class="font-thin text-[15px] text-[#C7C7C7] ml-[10px] w-[200px] h-[32px] font-inter">
                                    Progetto
                                </p>
                            </div>
                        </a>

                        <!-- Sub Menu Item -->
                        <div @click="selected = 'projects.project'"
                            class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                            :style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''">
                            <a href="{{ route('projects.project') }}" class="relative group">
                                <div class="mb-3">
                                    <img x-show="isExpanded"
                                        :src="selected === 'projects.project' || '{{ Route::currentRouteName() }}'
                                        === 'projects.project'
                                            ?
                                            '/icon/menu_exploded/progetti - color.svg' :
                                            '/icon/menu_exploded/progetti.svg'"
                                        alt="Progetti"
                                        class="w-[20px] expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]" />
                                </div>
                            </a>
                            <a href="{{ route('projects.project') }}"
                                :class="{
                                    'text-[#10BDD4]': selected === 'projects.project' ||
                                        '{{ Route::currentRouteName() }}'
                                    === 'projects.project',
                                    'text-[#B0B0B0]': selected !== 'projects.project' &&
                                        '{{ Route::currentRouteName() }}'
                                    !== 'projects.project'
                                }"
                                class="relative group font-light text-[15px] leading-[19px] opacity-100 w-[100px] ml-[25px] h-[32px]">
                                Progetti
                                <span
                                    class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                            </a>
                        </div>

                        <!-- Reusable Sub Menu Item Component -->
                        <template
                            x-for="item in [
                  { label: 'Pianificazione', icon: '/icon/menu_exploded/pianificazione.svg' },
                  { label: 'Mappa', icon: '/icon/menu_exploded/mappa.svg' },
                  { label: 'Progetti Archiviati', icon: '/icon/menu_exploded/progetti archiviati.svg' }
              ]">
                            <div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                                :style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''">
                                <a href="#" class="block group ml-2.5">
                                    <div class="mb-3">
                                        <img x-show="isExpanded" :src="item.icon" :alt="item.label"
                                            class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                    </div>
                                </a>
                                <a href="#"
                                    class="relative group font-light text-[15px] leading-[19px] text-[#B0B0B0] opacity-100 w-[100px] ml-[8px] h-[32px] whitespace-pre-line"
                                    :class="{ 'pl-4': !isExpanded }" x-text="item.label">
                                </a>
                            </div>
                        </template>
                    </div>


                    <!-- Menu Item 3 - Operazioni e risorse -->
                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
                        x-bind:style="isExpanded ? 'display: flex' : ''">

                        <!-- Collapsed View -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-bind:hidden="isExpanded">
                                <img src="/icon/menu/operazioni e risorse.svg" alt="Operazioni e risorse"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p
                                    class="font-thin text-[15px] leading-[19px] tracking-[0px] text-[#C7C7C7] opacity-100 text-left font-inter w-[200px] ml-[10px] h-[32px]">
                                    Operazioni e risorse
                                </p>
                            </div>
                        </a>

                        <!-- Expanded View Sub Items -->
                        <template
                            x-for="item in [
                                { icon: 'magazzino', label: 'Magazzino' },
                                { icon: 'acquisti', label: 'Acquisti' },
                                { icon: 'riparazioni', label: 'Riparazioni' },
                                { icon: 'codici a barre', label: 'Codici a barre' }
                            ]">
                            <div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                                x-bind:style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''">
                                <a href="#" class="block group ml-2.5">
                                    <div class="mb-3">
                                        <img x-bind:hidden="!isExpanded"
                                            x-bind:src="'/icon/menu_exploded/' + item.icon + '.svg'"
                                            x-bind:alt="item.label"
                                            class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                    </div>
                                </a>
                                <a href="#"
                                    class="relative group whitespace-pre-line font-light text-[15px] leading-[19px] text-[#B0B0B0] opacity-100 w-[100px] ml-[8px] h-[32px]"
                                    x-bind:class="{ 'pl-4': !isExpanded }" x-text="item.label">
                                </a>
                            </div>
                        </template>
                    </div>

                    <!-- Menu Item 4-->
                    <!-- Menu Item - Dipendenti -->
                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
                        x-bind:style="isExpanded ? 'display: flex' : ''">

                        <!-- Collapsed View -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-bind:hidden="isExpanded">
                                <img src="/icon/menu/dipendenti.svg" alt="Dipendenti"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p
                                    class="font-thin text-[15px] leading-[19px] tracking-[0px] text-[#C7C7C7] opacity-100 text-left font-inter w-[200px] ml-[10px] h-[32px]">
                                    Dipendenti
                                </p>
                            </div>
                        </a>

                        <!-- Expanded View Sub Items -->
                        <template
                            x-for="item in [
    { icon: 'anagrafica dipendenti', labelExpanded: 'Anagrafica Dipendente', labelCollapsed: 'Anagrafica', route: '{{ route('projects.project') }}' },
    { icon: 'presenze dipendenti', labelExpanded: 'Presenze Dipendente', labelCollapsed: 'Presenze', route: '#' },
    { icon: 'ferie dipendenti', labelExpanded: 'Ferie Dipendente', labelCollapsed: 'Ferie', route: '#' },
    { icon: 'rimborsi dipendenti', labelExpanded: 'Rimborsi Dipendente', labelCollapsed: 'Rimborsi', route: '#' },
    { icon: 'richieste dipendenti', labelExpanded: 'Richieste Dipendente', labelCollapsed: 'Richieste', route: '#' },
    { icon: 'selezione personale', labelExpanded: 'Selezione personale', labelCollapsed: 'Selezione', route: '#' }
]">
                            <div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                                x-bind:style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''">
                                <a :href="item.route" class="block group ml-2.5">
                                    <div class="mb-3">
                                        <img x-bind:hidden="!isExpanded"
                                            x-bind:src="'/icon/menu_exploded/' + item.icon + '.svg'"
                                            x-bind:alt="item.labelExpanded"
                                            class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                    </div>
                                </a>
                                <a :href="item.route"
                                    class="relative group whitespace-pre-line font-light text-[15px] leading-[19px] text-[#B0B0B0] opacity-100 w-[100px] ml-[8px] h-[32px]"
                                    x-bind:class="{ 'pl-4': !isExpanded }"
                                    x-text="isExpanded ? item.labelExpanded : item.labelCollapsed">
                                    <span
                                        class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                </a>
                            </div>
                        </template>
                    </div>

                    <!-- Menu Item - Amministrazione -->
                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
                        x-bind:style="isExpanded ? 'display: flex' : ''">

                        <!-- Collapsed View -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-bind:hidden="isExpanded">
                                <img src="/icon/menu/amministrazione.svg" alt="Amministrazione"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p
                                    class="font-thin text-[15px] leading-[19px] tracking-[0px] text-[#C7C7C7] opacity-100 text-left font-inter w-[200px] ml-[10px] h-[32px]">
                                    Amministrazione
                                </p>
                            </div>
                        </a>

                        <!-- Expanded View Items -->
                        <template
                            x-for="item in [
    { icon: 'contabilità', label: 'Contabilità', route: '{{ route('projects.project') }}' }
]">
                            <div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                                x-bind:style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''">
                                <a :href="item.route" class="block group">
                                    <div>
                                        <img x-bind:hidden="!isExpanded"
                                            x-bind:src="'/icon/menu_exploded/' + item.icon + '.svg'"
                                            x-bind:alt="item.label"
                                            class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]">
                                    </div>
                                </a>
                                <a :href="item.route"
                                    class="relative group whitespace-pre-line font-light text-[15px] leading-[19px] text-[#B0B0B0] opacity-100 w-[100px] ml-[8px] h-[32px]"
                                    x-bind:class="{ 'pl-4': !isExpanded }" x-text="item.label">
                                    <span
                                        class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                </a>
                            </div>
                        </template>
                    </div>

                    <!-- Menu Item - Documenti -->
                    <div class="menu-item w-max-52 mr-5" :class="isExpanded ? '' : 'h-88 border-l-2 border-gray-200'"
                        x-bind:style="isExpanded ? 'height: 0px;' : ''">

                        <!-- Collapsed View -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-bind:hidden="isExpanded">
                                <img src="/icon/menu/documenti.svg" alt="Documenti"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p
                                    class="font-light text-[15px] leading-[19px] tracking-[0px] text-[#C7C7C7] opacity-100 text-left font-inter w-[200px] ml-[10px] h-[32px]">
                                    Documenti
                                </p>
                            </div>
                        </a>
                    </div>







                    <!-- Menu Item - CRM -->
                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
                        x-bind:style="isExpanded ? 'display: flex' : ''">

                        <!-- Collapsed View -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-bind:hidden="isExpanded">
                                <img src="/icon/menu/CRM.svg" alt="CRM"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p
                                    class="font-thin text-[15px] leading-[19px] text-[#C7C7C7] text-left font-inter w-[200px] ml-[10px] h-[32px]">
                                    CRM
                                </p>
                            </div>
                        </a>

                        <!-- Expanded View Items -->
                        <template
                            x-for="item in [
    {
        id: 'crm.leads',
        label: 'Lead',
        icon: 'lead',
        route: '{{ route('crm.leads') }}',
        isActive: '{{ Route::currentRouteName() }}' === 'crm.leads'
    },
    {
        id: 'crm.contacts',
        label: 'Contatti',
        icon: 'contatti',
        route: '{{ route('crm.contacts') }}',
        isActive: '{{ Route::currentRouteName() }}' === 'crm.contacts'
    },
    {
        id: 'crm.clients',
        label: 'Clienti',
        icon: 'clienti',
        route: '{{ route('crm.clients') }}',
        isActive: '{{ Route::currentRouteName() }}' === 'crm.clients'
    },
    {
        id: 'selling',
        label: 'Vendite',
        icon: 'vendite',
        route: '#',
        isActive: false
    },
    {
        id: 'service',
        label: 'Servizi & prezzi',
        icon: 'servizi e prezzi',
        route: '#',
        isActive: false
    }
]"
                            :key="item.id">

                            <div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                                x-bind:style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''"
                                @click="selected = item.id">

                                <!-- Icon -->
                                <a :href="item.route" class="block group">
                                    <div class="mb-3">
                                        <img x-bind:hidden="!isExpanded"
                                            :src="item.isActive || selected === item.id ?
                                                '/icon/menu_exploded/' + item.icon + ' - color.svg' :
                                                '/icon/menu_exploded/' + item.icon + '.svg'"
                                            :alt="item.label"
                                            class="font-light w-[20px] expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]" />
                                    </div>
                                </a>

                                <!-- Label -->
                                <a :href="item.route"
                                    :class="{
                                        'text-[#10BDD4]': item.isActive || selected === item.id,
                                        'text-[#B0B0B0]': !(item.isActive || selected === item.id),
                                        'mt-5': isExpanded,
                                        'font-light text-[15px] leading-[19px] opacity-100 w-[100px] ml-[25px] h-[32px]': true
                                    }"
                                    class="relative group whitespace-pre-line">
                                    <span x-text="item.label"></span>
                                    <span
                                        class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                </a>

                            </div>
                        </template>
                    </div>
                    <!-- Menu Item - Gestione -->
                    <div class="menu-item w-max-52 mr-5"
                        :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
                        x-bind:style="isExpanded ? 'display: flex' : ''">

                        <!-- Collapsed View -->
                        <a href="#" class="block group ml-2.5 h-[32px]">
                            <div class="flex w-[200px] h-[17px]" x-bind:hidden="isExpanded">
                                <img src="/icon/menu/CRM.svg" alt="Gestione"
                                    class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
                                <p
                                    class="font-thin text-[15px] leading-[19px] text-[#C7C7C7] text-left font-inter w-[200px] ml-[10px] h-[32px]">
                                    Gestione
                                </p>
                            </div>
                        </a>

                        <!-- Expanded View Items -->
                        <template
                            x-for="item in [
    {
        id: 'gestione.task',
        label: 'Gestione task',
        icon: 'pianificazione',
        route: '#',
        isActive: false
    },
    {
        id: 'gestione.calendar',
        label: 'Calendario',
        icon: 'mappa',
        route: '#',
        isActive: false
    }
]"
                            :key="item.id">

                            <div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
                                x-bind:style="isExpanded ? 'padding: 0; justify-items: baseline;' : ''"
                                @click="selected = item.id">

                                <!-- Icon -->
                                <a :href="item.route" class="block group">
                                    <div class="mb-3">
                                        <img x-bind:hidden="!isExpanded"
                                            :src="'/icon/menu_exploded/' + item.icon + '.svg'" :alt="item.label"
                                            class="expand-images object-cover transition duration-300 group-hover:scale-105 m-[15px]" />
                                    </div>
                                </a>

                                <!-- Label -->
                                <a :href="item.route"
                                    :class="{
                                        'text-[#10BDD4]': item.isActive || selected === item.id,
                                        'text-[#B0B0B0]': !(item.isActive || selected === item.id),
                                        'mt-5': isExpanded,
                                        'font-light text-[15px] leading-[19px] opacity-100 w-[100px] ml-[25px] h-[32px]': true
                                    }"
                                    class="relative group whitespace-pre-line">
                                    <span x-text="item.label"></span>
                                    <span
                                        class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
                                </a>

                            </div>
                        </template>
                    </div>

                </div>
            </div>

            <!-- Hidden Extra Content (Will be shown when expanded) -->
            <div id="expanded-content" class="overflow-x-auto" x-show="isExpanded">
                <div class="flex space-x-6 min-w-max">
                    <!-- Extra Menu Item content -->
                </div>
            </div>

            <!-- Expand Button at the Bottom -->
            <div class="text-center">
                <button id="expand-button" @click="toggleExpand()"
                    class="w-[40px] h-[40px] ml-[105px] fixed rounded-full bg-[#10BDD4] hover:bg-cyan-800 hover:cursor-pointer flex items-center justify-center focus:outline-none transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512"
                        fill="white">
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
</div>
