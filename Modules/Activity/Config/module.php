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
                    'url' => 'activities',
                    'action' => 'list',
                    'show' => 1,
                    'order' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'View Activities',
                    'url' => 'activity/view',
                    'action' => 'view',
                    'order' => 2,
                    'show' => 0,
                    'status' => 1,
                ],
            ],
        ],

    ],

];
