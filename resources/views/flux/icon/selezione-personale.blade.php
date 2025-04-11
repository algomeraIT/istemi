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

<svg xmlns="http://www.w3.org/2000/svg" width="21.207" height="21.207" viewBox="0 0 21.207 21.207" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-2.5 -2.5)"><circle cx="8.889" cy="8.889" r="8.889" transform="translate(3 3)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><line x1="4.833" y1="4.833" transform="translate(18.167 18.167)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
