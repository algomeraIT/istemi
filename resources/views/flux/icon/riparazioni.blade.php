@php $attributes = $unescapedForwardedAttributes ?? $attributes; @endphp

@props([
	'variant' => 'outline',
])

@php
$classes = Flux::classes('shrink-0')
->add(match($variant) {
	'outline' => '[:where(&)]:size-6',
	'solid' => '[:where(&)]:size-6',
	'mini' => '[:where(&)]:size-5',
	'micro' => '[:where(&)]:size-4',
});
@endphp

<svg xmlns="http://www.w3.org/2000/svg" width="21.275" height="21.275" viewBox="0 0 21.275 21.275" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<path d="M15.313,6.525a1.052,1.052,0,0,0,0,1.473L17,9.682a1.052,1.052,0,0,0,1.473,0l3.967-3.967a6.314,6.314,0,0,1-8.356,8.356L6.81,21.342a2.232,2.232,0,0,1-3.157-3.157l7.272-7.272A6.314,6.314,0,0,1,19.28,2.558L15.323,6.515Z" transform="translate(-2.333 -1.387)" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
</svg>
