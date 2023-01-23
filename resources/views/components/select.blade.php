@props(['input_error' => ''])
<select {{ $attributes->merge(['class' => 'select select-bordered w-full ' . $input_error]) }}>
    {{ $slot }}
</select>
{{ $label_bawah ?? '' }}
