@extends('layouts.admin')

@section('content')
    <div x-data>
        @livewire('admin.setting.user-datatable')
        @livewire('admin.setting.user-form')
    </div>
@endsection