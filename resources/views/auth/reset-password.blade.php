@extends('layouts.auth')
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>ITEM INVENTORY SYSTEM</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('static/item inventory logo.png') }}" />

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

    <!-- Custom CSS for specific page.  -->
    @stack('page-styles')
    @livewireStyles
</head>
@section('content')
    <form class="card card-md" action="{{ route('password.store') }}" method="POST" autocomplete="off">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="card-body">
            <h2 class="card-title text-center mb-4">
                Reset Password
            </h2>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $request->email) }}"
                       placeholder="Enter email"
                >

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password"
                           autocomplete="off"
                    >

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Password Confirmation"
                           autocomplete="off"
                    >

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Reset Password
                </button>
            </div>
        </div>
    </form>
@endsection
