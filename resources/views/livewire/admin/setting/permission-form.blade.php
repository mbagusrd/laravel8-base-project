<div x-data="{ show: @entangle('show') }" x-show="show">
    @if (session()->has('alert-success'))
        <x-alert-fixed alert="success" closebutton="no" autoclose="yes">{{ session('alert-success') }}
        </x-alert-fixed>
    @endif
    @if (session()->has('alert-error') or $errors->any())
        <x-alert-fixed alert="error" closebutton="no" autoclose="yes">
            {{ session('alert-error') }}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </x-alert-fixed>
    @endif
    <div class="w-full md:w-2/3 xl:w-1/2">
        <x-card>
            <div class="grid gap-4">
                <div>
                    <x-button class="btn-outline" wire:click="act_kembali">
                        < Kembali </x-button>
                </div>
                <div class="grid gap-4">
                    <div>
                        <label for="">Display Name</label>
                        <x-input wire:model.defer='input_display_name' wire:keydown.debounce.500ms='update_slug'>
                            @slot('label_bawah')
                                @error('input_display_name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Name *</label>
                        <x-input wire:model.defer='input_name' class="input-disabled" readonly>
                            @slot('label_bawah')
                                @error('input_name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Description</label>
                        <x-input wire:model.defer='input_description'>
                            @slot('label_bawah')
                                @error('input_description')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                </div>
                <div>
                    <div wire:loading>
                        <progress class="progress progress-primary" value="70" max="100"> </progress>
                    </div>
                    <div wire:loading.remove>
                        @if ($crud_mode == 'create')
                            <div>
                                <x-button class="btn-primary" wire:click="create_data">Tambah</x-button>
                            </div>
                        @elseif ($crud_mode == 'update')
                            <div>
                                <x-button class="btn-warning" wire:click="update_data">Ubah</x-button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>
