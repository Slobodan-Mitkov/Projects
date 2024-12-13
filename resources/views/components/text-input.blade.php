@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-light-grey rounded-md shadow-sm']) }}>