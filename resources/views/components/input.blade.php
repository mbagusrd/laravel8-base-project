@props(['type' => 'text', 'class' => ''])
<input type="{{ $type }}" {{ $attributes->merge(['class' => 'input input-bordered w-full ' . $class]) }}>
@if (isset($label_bawah))
    {{ $label_bawah }}
@endif
