<div class="max-w-md mx-auto">
    <form wire:submit.prevent='do_login'>
        <x-card>
            @if (session()->has('alert-error'))
                <x-alert alert="warning">
                    {{ session('alert-error') }}
                </x-alert>
            @endif
            @if (session()->has('alert-success'))
                <x-alert alert="success">
                    {{ session('alert-success') }}
                </x-alert>
            @endif
            <div class="mb-3">
                <label class="mb-2">Email
                    <x-input wire:model.defer="email" autocomplete='off' class="mt-2">
                        @error('email')
                            @slot('class', 'input-error')
                            @slot('label_bawah')
                                <label class="label text-error">{{ $message }}</label>
                            @endslot
                        @enderror
                    </x-input>
                </label>
            </div>
            <div class="mb-3">
                <label class="mb-2">Password
                    <x-input wire:model.defer="password" type='password' class="mt-2">
                        @error('password')
                            @slot('class', 'input-error')
                            @slot('label_bawah')
                                <label class="label text-error">{{ $message }}</label>
                            @endslot
                        @enderror
                    </x-input>
                </label>
            </div>
            <x-button class="btn-primary btn-block" type="submit">
                Login
            </x-button>
        </x-card>
    </form>
    <script>
        window.addEventListener('goto', function(params) {
            location.href = params.detail.url
        })
    </script>
</div>
