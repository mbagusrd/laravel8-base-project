@extends('layouts.admin')

@section('content')
    <div x-data>
        @livewire('admin.setting.role-datatable')
        @livewire('admin.setting.role-form')
    </div>
@endsection
