@extends('layouts.app')

@section('title', 'Logout')

@section('content')
<div class="container text-center mt-5">
    <h1>Are you sure you want to log out?</h1>
    <form action="{{ route('logout.post') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
