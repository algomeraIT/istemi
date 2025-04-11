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

<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-1.5 -1.5)"><circle cx="10" cy="10" r="10" transform="translate(2 2)" fill="none" stroke="#c7c7c7" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M12,6v6l4,2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
