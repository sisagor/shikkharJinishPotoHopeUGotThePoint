@extends('auth.layout')
@section('content')

    <form  action="{{ route('password.update') }}" class="signin-form" method="post">
        @csrf
        <input type="hidden" name="token" value="{{request()->token}}">
        <input type="hidden" name="email" value="{{request()->get('email')}}">

        <div class="form-group mb-3">
            <label class="label" for="name">{{__('New Password')}}</label>
            <input id="password" type="password"  placeholder="{{__('new password')}}" class="form-control @error('password') is-invalid @enderror" name="password"
                   required autocomplete="off"/>
        </div>

        <div class="form-group mb-3">
            <label class="label" for="name">{{__('Confirm Password')}}</label>
            <input id="password" type="password" placeholder="{{__('confirm password')}}" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                   required autocomplete="off"/>
        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary rounded submit px-3"> {{ __('Update Password') }}</button>
        </div>
    </form>

@endsection

