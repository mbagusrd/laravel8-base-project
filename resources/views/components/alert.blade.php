@props(['alert' => 'info', 'closebutton' => 'yes', 'autoclose' => 'no'])
<div x-data="" x-ref="alertComponent"
    @if ($autoclose == 'yes') x-init="setTimeout(() => { $refs.alertComponent.remove() }, 4000);" @endif>
    <div class="hidden alert alert-info"></div>
    <div class="hidden alert alert-success"></div>
    <div class="hidden alert alert-warning"></div>
    <div class="hidden alert alert-error"></div>

    <div {{ $attributes->merge(['class' => 'shadow mb-2 text-white alert alert-' . $alert . ' ']) }}>
        <div>
            @if ($alert == 'success')
                <i class="bi bi-check-circle"></i>
            @elseif ($alert == 'error')
                <i class="bi bi-x-circle"></i>
            @elseif ($alert == 'warning')
                <i class="bi bi-exclamation-triangle"></i>
            @else
                <i class="bi bi-info-circle"></i>
            @endif
            <span>{{ $slot }}</span>
        </div>
        @if ($closebutton == 'yes')
            <div class="flex-none">
                <button class="btn btn-ghost btn-sm" @click="$refs.alertComponent.remove()">
                    <i class='bi bi-x-lg'></i>
                </button>
            </div>
        @endif
    </div>
</div>
