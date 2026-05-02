@extends('layouts.app')

@section('content')

<div class="login-section">
    <div class="login-box">

        <div class="logo">
            <img src="{{ asset('assets/images/logo/logo-light.png') }}" alt="Granny Logo">
        </div>

        <div class="login-subtitle">Welcome back</div>
        <h2>Sign In</h2>
        <div class="login-divider"></div>

        @if(session('success'))
            <div class="alert-success">
               <i class="fa fa-check-circle"></i>
               {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert-danger">
                <i class="fa fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <div class="input-icon">
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                    <i class="fa fa-envelope"></i>
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                    >
                    <i class="fa fa-lock"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Enter Restaurant
            </button>
        </form>

        <div class="btn-google-divider">
            <span>or</span>
        </div>

        {{-- Google Button --}}
<a href="{{ route('redirect') }}" class="btn-google">
    <svg class="btn-google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
    </svg>
    Continue with Google
</a>

        {{-- Register Link --}}
        <div class="login-register-link">
            Don't have an account? <a href="{{ route('register') }}">Create one</a>
        </div>

        <div class="login-footer">
            &copy; {{ date('Y') }} Granny Restaurant. All Rights Reserved.
        </div>

    </div>
</div>

@endsection