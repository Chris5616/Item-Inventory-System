@extends('layouts.auth')
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>ITEM INVENTORY SYSTEM</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('static/INvent.png') }}" />

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    @stack('page-styles')
    @livewireStyles
</head>

@section('content')
<form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off">
    @csrf
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Create new account</h2>

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Your name" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="your@email.com" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text"
                   name="username"
                   value="{{ old('username') }}"
                   class="form-control @error('username') is-invalid @enderror"
                   placeholder="Your username" required>
            @error('username')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password" required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Confirm password" required>
        </div>

        <!-- Terms -->
        <div class="mb-3">
            <label class="form-check">
                <input type="checkbox"
                       name="terms-of-service"
                       id="terms-of-service"
                       class="form-check-input @error('terms-of-service') is-invalid @enderror">
                <span class="form-check-label">
                    Agree to the <a href="{{ route('terms') }}" tabindex="-1">terms and policy</a>.
                </span>
            </label>
            @error('terms-of-service')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit -->
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Create new account') }}
            </button>
        </div>
    </div>
</form>

<div class="text-center text-secondary mt-3">
    Already have an account?
    <a href="{{ route('login') }}" tabindex="-1">Log in</a>
</div>
@endsection
