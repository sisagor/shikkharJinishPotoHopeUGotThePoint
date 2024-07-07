@component('mail::message')

    #{{ trans('mail.greeting', ['receiver' => $data['name']]) }}

    {!! trans('mail.attendance_late.message', ['date' => \Carbon\Carbon::now()->format('d-m-Y'), 'hour' => $data['hour']]) !!}


    @component('mail::button', ['url' => $url, 'color' => 'green'])
        {{ trans('mail.attendance_late.button_text') }}
    @endcomponent


    #{{ trans('mail.thanks') }},

    #{{ get_org_title() }},

    #{{ get_platform_title() }}

@endcomponent
