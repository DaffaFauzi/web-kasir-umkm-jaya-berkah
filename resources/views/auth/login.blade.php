@extends('layouts.login')

@section('content')
<style>
    body, html {
        height: 100%;
        margin: 0;
    }
    .split {
        height: 100vh;
        width: 50%;
        position: fixed;
        top: 0;
        overflow-x: hidden;
        padding-top: 60px;
    }
    .left {
        left: 0;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .right {
        right: 0;
        background-color: #e8f5e9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .login-form {
        width: 80%;
        max-width: 400px;
    }
    .btn-login {
        background-color: #2e7d32;
        color: white;
    }
</style>

<div class="split left">
    <div class="login-form">
        <h3 class="mb-4" style="color: #2e7d32;">Login Admin</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif

            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>
</div>

<div class="split right">
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="max-width: 250px; margin-bottom: 20px;">
</div>
@endsection
