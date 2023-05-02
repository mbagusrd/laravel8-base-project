<div {{ $attributes->merge(['class' => 'card bg-base-100 shadow-lg']) }}>
    @if ($card_title ?? '')
        <div class="card-title px-4 pt-4">
            {{ $card_title ?? '' }}
        </div>
    @endif
    <div class="card-body p-4">
        {{ $slot ?? '' }}
    </div>
</div>
