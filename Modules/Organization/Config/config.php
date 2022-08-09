<?php

return [
    'name' => 'Organization',

    #leave policy apply at:
    'apply_at' => [
        \Modules\Organization\Entities\LeavePolicy::APPLY_AFTER_JOINING => "After Joining",
        \Modules\Organization\Entities\LeavePolicy::APPLY_AFTER_PROVISION => "After Provision Period"
    ]

];
