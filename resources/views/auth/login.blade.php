@extends('auth.layout')

@section('content')

    <form action="{{ route('login') }}" class="signin-form" method="post">
        @csrf
        <div class="form-group mb-3">
            <label class="label" for="name">{{__('Email')}}</label>
            <input type="text" class="form-control" placeholder="Email" name="email" required>
        </div>
        <div class="form-group mb-3">
            <label class="label" for="password">{{__('Password')}}</label>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary rounded submit px-3"> {{ __('Login') }}</button>
        </div>
        <div class="form-group d-md-flex">
            <div class="col-md-6 col-sm-6 col-6 pull-left">
                <label class="checkbox-wrap checkbox-primary mb-0">  {{ __('Remember Me') }}
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-md-6 col-sm-6 col-6 pull-right">
                @if (Route::has('password.request'))
                    <a class="reset_pass" target="_blank" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>


@endsection
