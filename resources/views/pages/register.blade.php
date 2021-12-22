@extends('layouts.app')

@section('content')
<form action="{{ route('register.store') }}" method="POST" class="form-signin">
    @csrf
    <x-alert></x-alert>
    <img class="mb-4" src="{{ asset('logo.jpg') }}" alt="Logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
    <label for="inputName" class="sr-only">Full Name</label>
    <input type="text" name="name" id="inputName" class="form-control" placeholder="Full Name" required autofocus value="{{ old('name') }}">
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required value="{{ old('email') }}">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <div class="checkbox mb-3">
        <a href="{{ route('login') }}" class="btn btn-link">Login</a>
    </div>
    <p class="mt-5 mb-3 text-muted">&copy; {{ \Carbon\Carbon::now()->year . ' Laramerce' }}</p>
</form>
@endsection