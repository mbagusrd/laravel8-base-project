@props(['alert' => 'info', 'closebutton' => 'yes', 'autoclose' => 'no'])
<div x-data="" x-ref="alertfixed" x-init="@if ($autoclose == 'yes') setTimeout(() => { $refs.alertfixed.remove() }, 4000); @endif"
    class="fixed mx-5 right-0 top-1 z-20 sm:w-full md:w-2/3 lg:w-1/3">
    <div {{ $attributes->merge(['class' => 'shadow mb-2 alert alert-' . $alert]) }}>
        <div class="w-full @if ($alert != 'warning') text-white @endif">
            <div class="flex-none">
                @if ($alert == 'success')
                    <i class="bi bi-check-circle"></i>
                @elseif ($alert == 'error')
                    <i class="bi bi-x-circle"></i>
                @elseif ($alert == 'warning')
                    <i class="bi bi-exclamation-triangle"></i>
                @else
                    <i class="bi bi-info-circle"></i>
                @endif
            </div>
            <span class="flex-1">{{ $slot }}</span>
            @if ($closebutton == 'yes')
                <div class="justify-end">
                    <button class="btn btn-ghost btn-sm" @click="$refs.alertfixed.remove()"><i
                            class='bi bi-x-lg'></i></button>
                </div>
            @endif
        </div>
    </div>

    <div class="hidden alert alert-info"></div>
    <div class="hidden alert alert-success"></div>
    <div class="hidden alert alert-warning"></div>
    <div class="hidden alert alert-error"></div>
</div>
