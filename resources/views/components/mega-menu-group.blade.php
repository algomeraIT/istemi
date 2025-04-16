@props(['label', 'baseIcon'])

<div class="menu-item w-max-52 mr-5"
     :class="isExpanded ? 'h-30 border-b-2 border-gray-200' : 'h-88 border-l-2 border-gray-200'"
     x-bind:style="isExpanded ? 'display: flex;' : ''">
    <!-- Main Label (Collapsed View) -->
    <a href="#" class="block group ml-2.5 h-[32px]">
        <div class="flex w-[200px] h-[17px]" x-show="!isExpanded">
            <img src="{{ $baseIcon }}" alt="{{ $label }}"
                class="mt-[4px] object-cover transition duration-300 group-hover:scale-105">
            <p class="font-thin text-[15px] text-[#C7C7C7] ml-[10px] w-[200px] h-[32px] font-inter">
                {{ $label }}
            </p>
        </div>
    </a>

    <!-- Sub-Menu Items (Expanded View) -->
    <div class="grid" x-bind:style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''">
         {{ $subItems }}
    </div>
</div>