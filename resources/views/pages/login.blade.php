@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login.auth') }}" class="form-signin">
    @csrf
    <x-alert></x-alert>
    <img class="mb-4" src="{{ asset('logo.jpg') }}" alt="Logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus value="{{ old('email') }}">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    <div class="checkbox mb-3">
        <a href="{{ route('register') }}" class="btn btn-link">Register</a>
    </div>
    <p class="mt-5 mb-3 text-muted">&copy; {{ \Carbon\Carbon::now()->year . ' Laramerce' }}</p>
</form>
@endsection
