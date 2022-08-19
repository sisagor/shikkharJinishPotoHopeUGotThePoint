<?php

use \App\Models\Module;

return [
    'name' => 'Activities',
    'url' => 'activities',
    'scope' => json_encode([Module::SCOPE_COMMON]),
    'icon' => 'fa fa-history',
    'order' => 8,
    'status' => 0,
    'submodules' => [
        [
            'name' => 'Activities',
            'show' => 0,
            'order' => 1,
            'status' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'menu' => [
                [
                    'name' => 'Activities',
                    'url' => 'activities/activities',
                    'action' => 'activities.activities',
                    'show' => 1,
                ],
                [
                    'name' => 'View Activity',
                    'url' => 'activities/activity/view',
                    'action' => 'activities.activity.view',
                    'show' => 0,
                ],
            ],
        ],

    ],

];
