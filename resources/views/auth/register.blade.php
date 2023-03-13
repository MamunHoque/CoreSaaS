@extends('layouts.guest')

@section('title',  __('Register'))

@section('content')
    <div class="text-center mt-4">
        <h1 class="h2">Get started</h1>
        <p class="lead">
            Start creating the best possible user experience for you customers.
        </p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">{{__('Name')}}</label>
                        <input required autofocus class="form-control form-control-lg" type="text" name="name"
                               value="{{old('name')}}" placeholder="Enter your name"/>
                    </div>
                    <!-- Email Address -->
                    <div class="mb-3">
                        <label class="form-label">{{__('Email')}}</label>
                        <input required autofocus class="form-control form-control-lg" type="email" name="email"
                               value="{{old('email')}}" placeholder="Enter your email"/>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">{{__('Password')}}</label>
                        <input required class="form-control form-control-lg" type="password" name="password"
                               placeholder="Enter your password"/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('Confirm Password') }}</label>
                        <input required class="form-control form-control-lg" type="password" name="password_confirmation"
                               placeholder="Enter your password again"/>

                        <small>
                            <a href="{{ route('login') }}"> {{ __('Already registered?') }}</a>
                        </small>

                    </div>

                    <div class="text-center mt-3">
                        {{--<a href="index.html" class="btn btn-lg btn-primary"> {{ __('Log in') }}</a>--}}
                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

