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

<svg xmlns="http://www.w3.org/2000/svg" width="16.207" height="16.207" viewBox="0 0 16.207 16.207" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(0.707 0.5)"><line y1="14.737" x2="14.737" transform="translate(0 0.263)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M7,7H22V22" transform="translate(-7 -7)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
