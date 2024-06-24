<?php

use \App\Models\Module;

return [
    'name' => 'CMS',
    'url' => 'cms',
    'scope' => json_encode([Module::SCOPE_COMPANY]),
    'icon' => 'fa fa-briefcase',
    'status' => 1,
    'order' => 98,

    //Submodules
    'submodules' => [
        [
            'name' => 'Blogs',
            'show' => 0,
            'order' => 1,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Blog',
                    'url' => 'cms/blog/add',
                    'action' => 'cms.blog.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Blogs',
                    'url' => 'cms/blogs',
                    'action' => 'cms.blogs',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Blog',
                    'url' => 'cms/blog/edit',
                    'action' => 'cms.blog.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete Blog',
                    'url' => 'cms/blog/delete',
                    'action' => 'cms.blog.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'cms/blog/trash',
                    'action' => 'cms.blog.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'cms/blog/restore',
                    'action' => 'cms.blog.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'View Blog',
                    'url' => 'cms/blog/view',
                    'action' => 'cms.blog.view',
                    'show' => 0,
                ],
            ],
        ],

        [
            'name' => 'CMS',
            'show' => 0,
            'order' => 12,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Content',
                    'url' => 'cms/cms/add',
                    'action' => 'cms.cms.add',
                    'show' => 0,
                ],
                [
                    'name' => 'CMS',
                    'url' => 'cms/cms',
                    'action' => 'cms.cms',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit CMS',
                    'url' => 'cms/cms/edit',
                    'action' => 'cms.cms.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete CMS',
                    'url' => 'cms/cms/delete',
                    'action' => 'cms.cms.delete',
                    'show' => 0,
                ],
                [
                    'name' => 'View CMS',
                    'url' => 'cms/cms/view',
                    'action' => 'cms.cms.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete CMS',
                    'url' => 'cms/cms/delete',
                    'action' => 'cms.cms.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
