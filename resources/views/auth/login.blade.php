@extends('layouts.auth')

@section('content')
<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Login to your account</h2>

        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="your@email.com"
                       required autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Your password"
                       required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            {{-- <!-- Remember Me -->
            <div class="mb-3">
                <label for="remember" class="form-check">
                    <input type="checkbox"
                           id="remember"
                           name="remember"
                           class="form-check-input"
                           {{ old('remember') ? 'checked' : '' }}/>
                    <span class="form-check-label">Remember me on this device</span>
                </label>
            </div> --}}

            <!-- Submit -->
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Log in
                </button>
            </div>
        </form>
    </div>
</div>

<div class="text-center mt-3 text-gray-600">
    <p>Don't have an account yet?
        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 focus:outline-none focus:underline" tabindex="-1">Sign up</a>
        /
        <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:underline">I forgot my password</a>
    </p>
</div>
@endsection
