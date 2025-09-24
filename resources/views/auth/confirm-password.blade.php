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
    <form class="card card-md" action="{{ route('password.confirm') }}" method="POST" autocomplete="off" novalidate>
        @csrf
        <div class="card-body text-center">
            <div class="mb-4">
                <h2 class="card-title">
                    {{ __('Confirm Password') }}
                </h2>
                <p class="text-secondary">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
            </div>
            <div class="mb-4">
                <span class="avatar avatar-xl mb-3 shadow-none" style="background-image: url({{ Avatar::create(Auth::user()->name)->toBase64() }})"></span>
                <h3>{{ Auth::user()->name }}</h3>
            </div>
            <div class="mb-4">
                <label for="password" class="visually-hidden">
                    Password
                </label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password&hellip;">
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>
    </form>
@endsection
