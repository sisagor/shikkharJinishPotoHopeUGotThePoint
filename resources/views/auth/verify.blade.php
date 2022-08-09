@extends('layouts.app')

@section('content')


    <form action="{{ route('verification.resend') }}" class="signin-form" method="post">
        @csrf

        <div class="form-group mb-3">

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <label class="label"> {{ __('Before proceeding, please check your email for a verification link.') }}</label>
            <label class="label">{{ __('If you did not receive the email') }},</label>

        </div>

        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary rounded submit px-3">{{ __('click here to request another') }}</button>
        </div>

    </form>

@endsection
