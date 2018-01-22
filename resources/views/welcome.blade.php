@extends('layouts.main')
@section('content')
        
@if (Route::has('login'))
    <div class="top-right links">
        @if (Auth::check())
            <a href="{{ url('/') }}">Home</a> or
            <a href="{{ url('logout') }}">Logout</a>


        @else
            <a href="{{ url('/login') }}">Login</a> or
            <a href="{{ url('/register') }}">Register</a>
        @endif
    </div>
@endif  

   
@stop