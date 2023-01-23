@props(['input_error' => ''])
<textarea {{ $attributes->merge(['class' => 'textarea textarea-bordered w-full ' . ($input_error ?? '')]) }}></textarea>
@if (isset($label_bawah))
    {{ $label_bawah }}
@endif
