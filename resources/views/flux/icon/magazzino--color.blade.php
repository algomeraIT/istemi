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

<svg xmlns="http://www.w3.org/2000/svg" width="21" height="23.338" viewBox="0 0 21 23.338" {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true">
<g transform="translate(-2.5 -1.473)"><line x1="10" y1="5.767" transform="translate(8 4.455)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M23,17.555V8.666a2.222,2.222,0,0,0-1.111-1.922L14.111,2.3a2.222,2.222,0,0,0-2.222,0L4.111,6.744A2.222,2.222,0,0,0,3,8.666v8.889a2.222,2.222,0,0,0,1.111,1.922l7.778,4.444a2.222,2.222,0,0,0,2.222,0l7.778-4.444A2.222,2.222,0,0,0,23,17.555Z" transform="translate(0)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><path d="M3.27,6.96l9.7,5.611,9.7-5.611" transform="translate(0.03 0.551)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/><line y1="11.2" transform="translate(13 13.111)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/></g>
</svg>
