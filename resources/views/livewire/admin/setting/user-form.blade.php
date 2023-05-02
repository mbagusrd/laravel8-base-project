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
                        <label for="">Nama</label>
                        <x-input wire:model.defer='input_name'>
                            @slot('label_bawah')
                                @error('input_name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Email</label>
                        <x-input wire:model.defer='input_email'>
                            @slot('label_bawah')
                                @error('input_email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Password</label>
                        @if ($crud_mode == 'update')
                            <div class="text-sm">(kosongkan jika tidak ingin mengubah password)</div>
                        @endif
                        <x-input wire:model.defer='input_password'>
                            @slot('label_bawah')
                                @error('input_password')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Password Konfirmasi</label>
                        <x-input wire:model.defer='input_password_confirm'>
                            @slot('label_bawah')
                                @error('input_password_confirm')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-input>
                    </div>
                    <div>
                        <label for="">Role</label>
                        <x-select wire:model.defer='input_role'>
                            <option value="">Tidak ada role</option>
                            @foreach ($role_list as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                            @endforeach
                            @slot('label_bawah')
                                @error('input_role')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            @endslot
                        </x-select>
                    </div>
                </div>
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
