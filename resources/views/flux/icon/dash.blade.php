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

<svg xmlns="http://www.w3.org/2000/svg" width="19.182" height="21" viewBox="0 0 19.182 21" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-2.5 -1.5)"><path d="M3,9l9.091-7,9.091,7V20a2.01,2.01,0,0,1-2.02,2H5.02A2.01,2.01,0,0,1,3,20Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M9,22V12h6.061V22" transform="translate(0.061 0)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
