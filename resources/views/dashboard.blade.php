@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard</h2>
    <div class="card">
        <div class="card-body">
            <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
            <a href="{{ route('edit.profile') }}" class="btn btn-primary">Edit Profile</a>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

@endsection