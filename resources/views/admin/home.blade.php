@extends('layouts.admin')

@section('content')
    @auth
        Selamat Datang, {{ auth()->user()->name }}
    @endauth
    @guest
        @livewire('admin.login')
    @endguest
@endsection
