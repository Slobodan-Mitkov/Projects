@props(['active'])

@php
$classes = ($active ?? false)
? 'dashboard-nav-button inline-flex items-center border-b-2 border-indigo-400 text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700'
: 'dashboard-nav-button inline-flex items-center border-b-2 border-transparent text-sm font-medium leading-5border-gray-300 focus:outline-none focus: focus:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>