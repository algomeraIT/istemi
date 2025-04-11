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

<svg xmlns="http://www.w3.org/2000/svg" width="25.444" height="21" viewBox="0 0 25.444 21" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-0.5 -2.5)"><path d="M23.444,8V21H3V8" transform="translate(0 2)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><rect width="24.444" height="5" transform="translate(1 3)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><line x2="4" transform="translate(11.222 13)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
