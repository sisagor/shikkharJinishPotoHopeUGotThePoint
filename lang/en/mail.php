<?php

return [

    'greeting' => 'Hello :receiver',
    'thanks' => 'Thanks',

    'leave_request_approved' => [
        'subject' => 'Your leave application has been approved.',
        'message' => 'Your leave application has been approved by admin :date. you can see your application follow the link',
        'button_text' => 'Approved Applications',
    ],

    'leave_request_rejected' => [
        'subject' => 'Your leave application has been rejected.',
        'message' => 'Your leave application has been rejected by admin :date. you can see your application follow the link',
        'button_text' => 'Rejected Applications',
    ],

    'attendance_absent' => [
        'subject' => 'You was absent today.',
        'message' => 'you was absent today :date. If you feel you have valid reason for absent please apply for leave. otherwise absent deduction will apply',
        'button_text' => 'Apply for leave',
    ],

    'attendance_late' => [
        'subject' => 'You was :hour late today',
        'message' => 'you was :hour late today :date. If you feel you have valid reason for late please apply for leave. otherwise absent deduction will apply',
        'button_text' => 'Apply for leave',
    ],


];
