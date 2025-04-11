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

<svg xmlns="http://www.w3.org/2000/svg" width="21" height="19.182" viewBox="0 0 21 19.182" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-0.5 -1.5)"><path d="M1,5.636V20.182l6.364-3.636,7.273,3.636L21,16.545V2L14.636,5.636,7.364,2Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><line y2="14.545" transform="translate(7.364 2)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><line y2="14.545" transform="translate(14.636 5.636)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
