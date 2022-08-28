@component('mail::message')

    #{{ trans('mail.greeting') }}

    {!! $body !!}


    #{{ trans('mail.thanks') }},

    #{{ get_org_title() }},

    #{{ get_platform_title() }}

@endcomponent
