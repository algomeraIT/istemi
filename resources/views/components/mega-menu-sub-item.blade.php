@props([
    'identifier' => null, 
    'label',
    'route',
    'collapsedIcon', 
    'expandedIcon'  
])

<div class="menu-item-inside grid lg:w-40 md:w-20 sm:w-12"
     x-bind:style="isExpanded ? 'padding: 20px; justify-items: baseline;' : ''"
     @if($identifier) @click="selected = '{{ $identifier }}'" @endif>
    <a href="{{ $route }}" class="block group ml-2.5">
        <div :class="isExpanded ? 'mb-3 w-5 h-5' : 'mb-3'">
            <img x-show="isExpanded"
                 :src="'{{ $expandedIcon }}'"
                 alt="{{ $label }}"
                 class="transition duration-300 group-hover:scale-105 m-[15px]" />
        </div>
    </a>
    <a href="{{ $route }}"
       class="relative group font-light text-[15px] leading-[19px] text-[#B0B0B0] opacity-100 w-[100px] ml-[8px] h-[32px]"
       :class="{ 'pl-4': !isExpanded }">
        {{ $label }}
        <span class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
    </a>
</div>