<div x-data="{ show: @entangle('show') }" x-show="show" class="mb-3">
    <x-card>
        @if (session()->has('alert-success'))
            <x-alert-fixed alert="success" closebutton="no" autoclose="yes">{{ session('alert-success') }}
            </x-alert-fixed>
        @endif
        @if (session()->has('alert-error'))
            <x-alert-fixed alert="error" closebutton="no" autoclose="yes">{{ session('alert-error') }}</x-alert-fixed>
        @endif
        <div class="w-full" wire:loading>
            <progress class="progress progress-primary" value="70" max="100"></progress>
        </div>
        <div wire:loading.remove>
            <div class="flex flex-col md:flex-row gap-3 mb-3">
                <div class="flex-auto">
                    <x-button class="btn-success" wire:click="act_tambah">
                        Tambah
                    </x-button>
                </div>
                <div class="flex-none">
                    <form wire:submit.prevent='cari'>
                        <div class="input-group">
                            <x-input type="text" wire:model.defer='cari' placeholder="Cari di sini"
                                autocomplete='off'>
                            </x-input>
                            <x-button type="submit" class="btn-primary">Cari</x-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full mb-3 table-zebra table-compact">
                    <thead>
                        <tr>
                            <td>Action</td>
                            <td>Display Name</td>
                            <td>Name</td>
                            <td>Description</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data_tables) > 0)
                            @foreach ($data_tables as $item)
                                <tr>
                                    <td>
                                        <x-button class="btn-error btn-sm"
                                            onclick="return confirm('Anda ingin hapus data ini?') || event.stopImmediatePropagation()"
                                            wire:click="delete_data('{{ $item->id }}')">Hapus</x-button>
                                        <x-button class="btn-warning btn-sm"
                                            wire:click="act_edit('{{ $item->id }}')">
                                            Edit</x-button>
                                    </td>
                                    <td>{{ $item->display_name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="font-bold text-center">Belum ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @if ($data_tables->total() > $pagination)
                <div class="p-2 border-2 rounded-xl" wire:loading.remove>
                    {{ $data_tables->links() }}
                </div>
            @endif
        </div>

    </x-card>
</div>
