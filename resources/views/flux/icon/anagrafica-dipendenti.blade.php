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

<svg xmlns="http://www.w3.org/2000/svg" width="21" height="17.363" viewBox="0 0 21 17.363" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-0.5 -2.5)"><path d="M17,21V19a4,4,0,0,0-4-4H5a4,4,0,0,0-4,4v2" transform="translate(0 -1.636)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><circle cx="4" cy="4" r="4" transform="translate(4.429 3)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M23,21V19a4,4,0,0,0-3-3.87" transform="translate(-2 -1.636)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M16,3.13a4,4,0,0,1,0,7.75" transform="translate(-1.58)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
