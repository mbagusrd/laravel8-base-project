@extends('layouts.admin')

@section('content')
    <div x-data>
        @livewire('admin.setting.permission-datatable')
        @livewire('admin.setting.permission-form')
    </div>
@endsection
