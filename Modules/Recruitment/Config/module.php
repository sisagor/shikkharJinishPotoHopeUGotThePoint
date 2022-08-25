<?php

use \App\Models\Module;

return [
    'name' => 'Recruitment',
    'url' => 'recruitment',
    'scope' => json_encode([Module::SCOPE_COMPANY]),
    'icon' => 'fa fa-briefcase',
    'status' => 1,
    'order' => 9,

    //Submodules
    'submodules' => [
        [
            'name' => 'Job Posting',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Job',
                    'url' => 'recruitment/job-posting/add',
                    'action' => 'recruitment.jobPosting.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Job Posting',
                    'url' => 'recruitment/job-posting',
                    'action' => 'recruitment.jobPosting',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Job',
                    'url' => 'recruitment/job-posting/edit',
                    'action' => 'recruitment.jobPosting.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Job',
                    'url' => 'recruitment/job-posting/delete',
                    'action' => 'recruitment.jobPosting.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'recruitment/job-posting/trash',
                    'action' => 'recruitment.jobPosting.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'recruitment/job-posting/restore',
                    'action' => 'recruitment.jobPosting.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'View Job',
                    'url' => 'recruitment/job-posting/view',
                    'action' => 'recruitment.jobPosting.view',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Applications',
            'show' => 0,
            'order' => 2,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Edit Application',
                    'url' => 'recruitment/application/edit',
                    'action' => 'recruitment.application.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Applications',
                    'url' => 'recruitment/applications',
                    'action' => 'recruitment.applications',
                    'show' => 1,
                ],
                [
                    'name' => 'Rejected Application',
                    'url' => 'recruitment/application/rejected',
                    'action' => 'recruitment.application.rejected',
                    'show' => 0,
                ],
                [
                    'name' => 'View Application',
                    'url' => 'recruitment/application/view',
                    'action' => 'recruitment.application.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'recruitment/application/trash',
                    'action' => 'recruitment.application.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'recruitment/application/restore',
                    'action' => 'recruitment.application.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'recruitment/application/delete',
                    'action' => 'recruitment.application.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Interview',
            'show' => 0,
            'order' => 3,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Interview',
                    'url' => 'recruitment/interview/add',
                    'action' => 'recruitment.interview.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Interviews',
                    'url' => 'recruitment/interviews',
                    'action' => 'recruitment.interviews',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Interview',
                    'url' => 'recruitment/interview/edit',
                    'action' => 'recruitment.interview.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'View Interview',
                    'url' => 'recruitment/interview/view',
                    'action' => 'recruitment.interview.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'recruitment/interview/trash',
                    'action' => 'recruitment.interview.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'recruitment/interview/restore',
                    'action' => 'recruitment.interview.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'recruitment/interview/delete',
                    'action' => 'recruitment.interview.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'Job Offer',
            'show' => 0,
            'order' => 10,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Offer',
                    'url' => 'recruitment/offer/add',
                    'action' => 'recruitment.offer.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Offer Job',
                    'url' => 'recruitment/offers',
                    'action' => 'recruitment.offers',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Offer',
                    'url' => 'recruitment/offer/edit',
                    'action' => 'recruitment.offer.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Offer',
                    'url' => 'recruitment/offer/delete',
                    'action' => 'recruitment.offer.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'View Offer',
                    'url' => 'recruitment/offer/view',
                    'action' => 'recruitment.offer.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'recruitment/offer/trash',
                    'action' => 'recruitment.offer.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'recruitment/offer/restore',
                    'action' => 'recruitment.offer.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'recruitment/offer/delete',
                    'action' => 'recruitment.offer.delete',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'CMS',
            'show' => 0,
            'order' => 10,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Content',
                    'url' => 'recruitment/cms/add',
                    'action' => 'recruitment.cms.add',
                    'show' => 0,
                ],
                [
                    'name' => 'CMS',
                    'url' => 'recruitment/cms',
                    'action' => 'recruitment.cms',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit CMS',
                    'url' => 'recruitment/cms/edit',
                    'action' => 'recruitment.cms.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete CMS',
                    'url' => 'recruitment/cms/delete',
                    'action' => 'recruitment.cms.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'View CMS',
                    'url' => 'recruitment/cms/view',
                    'action' => 'recruitment.cms.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete CMS',
                    'url' => 'recruitment/cms/delete',
                    'action' => 'recruitment.cms.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
