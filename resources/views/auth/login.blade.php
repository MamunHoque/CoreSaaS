@extends('layouts.guest')

@section('title',  __('Login'))

@section('content')
    <div class="text-center mt-4">
        <h1 class="h2">Welcome back, Charles</h1>
        <p class="lead">
            Sign in to your account to continue
        </p>
    </div>
    <div class="card">
        <div class="card-body">

            <div class="m-sm-4">
                <form class="row g-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input id="email" required class="form-control form-control-lg" @error('email') is-invalid @enderror
                        type="email" name="email" value="{{old('email')}}" placeholder="Enter your email"/>
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">{{__('Password')}}</label>
                        <input required class="form-control form-control-lg" type="password" name="password"
                               placeholder="Enter your password"/>
                        @if (Route::has('password.request'))
                            <small>
                                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                            </small>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div>
                        <label class="form-check">
                            <input class="form-check-input" id="remember_me" type="checkbox" value="remember-me" name="remember"
                                   checked>
                            <span class="form-check-label">
                              {{ __('Remember me') }}
                            </span>
                        </label>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Log in') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

