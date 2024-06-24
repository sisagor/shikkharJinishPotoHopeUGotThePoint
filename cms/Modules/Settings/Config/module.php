<?php

use \App\Models\Module;

return [
    'name' => 'Component Settings',
    'url' => 'component-settings',
    'scope' => json_encode([Module::SCOPE_COMMON]),
    'icon' => 'fa fa-cog',
    'status' => 1,
    'order' => 0,

    //Submodules
    'submodules' => [
        //Blog Categories
        [
            'name' => 'Blog Category',
            'show' => 0,
            'order' => 8,
            'scope' => json_encode([Module::SCOPE_COMMON]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Blog Category',
                    'url' => 'component-settings/job-category/add',
                    'action' => 'componentSettings.blogCategory.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Blog Categories',
                    'url' => 'component-settings/blog-categories',
                    'action' => 'componentSettings.blogCategories',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Category',
                    'url' => 'component-settings/blog-category/edit',
                    'action' => 'componentSettings.blogCategory.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'component-settings/blog-category/trash',
                    'action' => 'componentSettings.blogCategory.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'component-settings/blog-category/restore',
                    'action' => 'componentSettings.blogCategory.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'component-settings/blog-category/delete',
                    'action' => 'componentSettings.blogCategory.delete',
                    'show' => 0,
                ],
            ],
        ],
    ],

];
