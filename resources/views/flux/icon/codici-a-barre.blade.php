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

<svg xmlns="http://www.w3.org/2000/svg" width="21" height="16.025" viewBox="0 0 21 16.025" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<path d="M80.667,127.017,82.5,127a1.51,1.51,0,0,0,1.5-1.5V113.5a1.51,1.51,0,0,0-1.5-1.5l-1.83.017M67.333,112l-1.917.017a1.436,1.436,0,0,0-1.417,1.5v11.993a1.436,1.436,0,0,0,1.417,1.5L67.333,127m13.333-10.833v6.667M77.333,114.5v10M74,115.333v8.333M70.667,114.5v10m-3.333-8.333v6.667" transform="translate(-63.5 -111.496)" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
</svg>
