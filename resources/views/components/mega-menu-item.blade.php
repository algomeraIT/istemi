@props([
    'identifier',
    'label',
    'route',
    'collapsedIcon',  
    'activeIcon',     
    'expandedIcon'   
])

<div 
    :class="isExpanded ? 'h-30 border-b-2 border-gray-200 p-5 pl-10' : 'menu-item w-max-52 mr-5 flex'"
    @click="selected = '{{ $identifier }}'">
    <a href="{{ $route }}" class="block group ml-4 h-[32px]">
        <div class="w-5">
            <img x-show="!isExpanded"
                 :src="selected === '{{ $identifier }}' ? '{{ $activeIcon }}' : '{{ $collapsedIcon }}'"
                 alt="{{ $label }}"
                 class="transition duration-300 group-hover:scale-105" />
            <img x-show="isExpanded"
                 :src="selected === '{{ $identifier }}' ? '{{ $expandedIcon }}' : '{{ $collapsedIcon }}'"
                 alt="{{ $label }}"
                 class="transition duration-300 group-hover:scale-105" />
        </div>
    </a>
    <a href="{{ $route }}"
       :class="selected === '{{ $identifier }}' ? 'text-[#10BDD4]' : 'text-[#B0B0B0] group-hover:text-[#10BDD4]'"
       class="relative group font-light text-[15px] leading-[19px] w-[100px] ml-[8px] h-[32px]">
        {{ $label }}
        <span class="absolute left-0 bottom-0 w-0 h-[1px] bg-gray-400 transition-all duration-200 group-hover:w-full"></span>
    </a>
</div>