@extends('layouts.app')

@section('content')

<div class="register-section">
    <div class="register-box">

        <div class="logo">
            <img src="{{ asset('assets/images/logo/logo-light.png') }}" alt="Granny Logo">
        </div>

        <div class="register-subtitle">Join Us</div>
        <h2>Create Account</h2>
        <div class="register-divider"></div>

        @if($errors->any())
            <div class="alert-danger">
                <i class="fa fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name Row --}}
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <div class="input-icon">
                            <input
                                type="text"
                                name="first_name"
                                class="form-control {{ $errors->has('first_name') ? 'input-error' : '' }}"
                                placeholder="First Name"
                                value="{{ old('first_name') }}"
                                required
                            >
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <div class="input-icon">
                            <input
                                type="text"
                                name="last_name"
                                class="form-control {{ $errors->has('last_name') ? 'input-error' : '' }}"
                                placeholder="Last Name"
                                value="{{ old('last_name') }}"
                                required
                            >
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="form-group">
                <div class="input-icon">
                    <input
                        type="email"
                        name="email"
                        class="form-control {{ $errors->has('email') ? 'input-error' : '' }}"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                    <i class="fa fa-envelope"></i>
                </div>
            </div>

            {{-- Phone --}}
            <div class="form-group">
                <div class="input-icon">
                    <input
                        type="tel"
                        name="phone"
                        class="form-control {{ $errors->has('phone') ? 'input-error' : '' }}"
                        placeholder="Phone Number"
                        value="{{ old('phone') }}"
                        required
                    >
                    <i class="fa fa-phone"></i>
                </div>
            </div>

            {{-- Address --}}
            <div class="form-group">
                <div class="input-icon">
                    <textarea
                        name="address"
                        class="form-control form-textarea {{ $errors->has('address') ? 'input-error' : '' }}"
                        placeholder="Your Address"
                        required
                    >{{ old('address') }}</textarea>
                    <i class="fa fa-map-marker"></i>
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <div class="input-icon">
                    <input
                        type="password"
                        name="password"
                        class="form-control {{ $errors->has('password') ? 'input-error' : '' }}"
                        placeholder="Password"
                        required
                        autocomplete="new-password"
                    >
                    <i class="fa fa-lock"></i>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <div class="input-icon">
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm Password"
                        required
                        autocomplete="new-password"
                    >
                    <i class="fa fa-lock"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Create Account
            </button>

        </form>

        {{-- Login Link --}}
        <div class="login-register-link">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>

        <div class="login-footer">
            &copy; {{ date('Y') }} Granny Restaurant. All Rights Reserved.
        </div>

    </div>
</div>

@endsection