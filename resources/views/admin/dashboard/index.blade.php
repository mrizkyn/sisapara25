@extends('layouts.panel.main')
@section('main')
    INI ADMIN
    <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button class="dropdown-item" type="submit">Logout</button>
    </form>
@endsection
