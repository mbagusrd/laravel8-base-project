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
                        <label for="">Name *</label>
                        <x-input wire:model.defer='input_name'>
                            @slot('label_bawah')
                                @error('input_name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Display Name</label>
                        <x-input wire:model.defer='input_display_name'>
                            @slot('label_bawah')
                                @error('input_display_name')
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
                @if ($crud_mode == 'update')
                    <div>
                        <div class="text-lg">
                            Permissions (<a class="link" wire:click="select_all_permissions">Select All</a> | <a class="link" wire:click="clear_all_permissions">Clear All</a>)
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @if (count($array_permissions) > 0)
                                @foreach ($array_permissions as $key => $permission)
                                    <div class="form-control">
                                        <label class="cursor-pointer">
                                            <input type="checkbox" class="checkbox checkbox-info"
                                                wire:model.defer="array_permissions.{{ $key }}.assigned"
                                                {!! $permission['assigned'] ? 'checked' : '' !!} />
                                            <span class="label-text">{{ $permission['name'] }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                Belum Ada Permissions
                            @endif
                        </div>
                    </div>
                @endif
                <div>
                    <div wire:loading>
                        <progress class="progress progress-primary" value="70" max="100"> </progress>
                    </div>
                    <div wire:loading.remove>
                        @if ($crud_mode == 'create')
                            <div>
                                <x-button class="btn-primary" wire:click="tambah_data">Tambah</x-button>
                            </div>
                        @elseif ($crud_mode == 'update')
                            <div>
                                <x-button class="btn-warning" wire:click="edit_data">Ubah</x-button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>
