<?php

return [
    'name' => 'Recruitment',

    'job_status' => [
        ['key' => "open" , 'value' => "Open"],
        ['key' => "closed" , 'value' => "Closed"],
    ],

    'app_status' => [
        ['key' => "pending" , 'value' => "Pending"],
        ['key' => "approved" , 'value' => "Approved"],
        ['key' => "rejected" , 'value' => "Rejected"],
        ['key' => "interview" , 'value' => "Interview"],
        ['key' => "offer_job" , 'value' => "Offer Job"],
        ['key' => "confirmed" , 'value' => "Confirmed"],
    ],

    'interview_status' => [
        ['key' => "scheduled" , 'value' => "Scheduled"],
        ['key' => "pass" , 'value' => "Pass"],
        ['key' => "fail" , 'value' => "Fail"],
    ]


];
