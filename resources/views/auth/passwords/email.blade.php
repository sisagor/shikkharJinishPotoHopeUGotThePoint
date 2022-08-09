@extends('auth.layout')
@section('content')

    <form action="{{ route('password.email') }}" class="signin-form" method="post">
        @csrf
        <div class="form-group mb-3">
            <label class="label" for="name">{{__('Email')}}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary rounded submit px-3"> {{ __('Send Password Reset Link') }}</button>
        </div>
    </form>

@endsection
