@extends('layouts.admin')

@section('content')
    <div x-data>
        @livewire('admin.setting.user-datatable')
        @livewire('admin.setting.user-form')
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('viewMode', 'datatable');
        })
    </script>
@endsection
