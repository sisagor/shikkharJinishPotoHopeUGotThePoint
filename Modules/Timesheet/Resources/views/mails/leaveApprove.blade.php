@component('mail::message')

    #{{ trans('mail.greeting', ['receiver' => $data->first_name. ' '.$data->last_name]) }}

    {!! trans('mail.leave_request_approved.message', ['date' => \Carbon\Carbon::now()->diffForHumans()]) !!}


    @component('mail::button', ['url' => $url, 'color' => 'green'])
        {{ trans('mail.leave_request_approved.button_text') }}
    @endcomponent


    #{{ trans('mail.thanks') }},

    #{{ get_org_title() }},

    #{{ get_platform_title() }}

@endcomponent
