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
            'name' => 'Books',
            'show' => 0,
            'order' => 12,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'New Book',
                    'url' => 'cms/book/add',
                    'action' => 'cms.book.add',
                    'show' => 0,
                ],
                [
                    'name' => 'Books',
                    'url' => 'cms/books',
                    'action' => 'cms.books',
                    'show' => 1,
                ],
                [
                    'name' => 'Edit Book',
                    'url' => 'cms/book/edit',
                    'action' => 'cms.book.edit',
                    'show' => 0,
                ],
                [
                    'name' => 'View Book',
                    'url' => 'cms/book/view',
                    'action' => 'cms.book.view',
                    'show' => 0,
                ],
                [
                    'name' => 'Trash',
                    'url' => 'cms/book/trash',
                    'action' => 'cms.book.trash',
                    'show' => 0,
                ],
                [
                    'name' => 'Restore',
                    'url' => 'cms/book/restore',
                    'action' => 'cms.book.restore',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'cms/book/delete',
                    'action' => 'cms.book.delete',
                    'show' => 0,
                ],
            ],
        ],
        [
            'name' => 'Contact-Us',
            'show' => 0,
            'order' => 13,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Contact-Us',
                    'url' => 'cms/contact-us',
                    'action' => 'cms.contact-us',
                    'show' => 1,
                ],
            
            ],
        ],
        [
            'name' => 'Comments',
            'show' => 0,
            'order' => 13,
            'scope' => json_encode([Module::SCOPE_COMPANY]),
            'status' => 1,
            'menu' => [
                [
                    'name' => 'Comments',
                    'url' => 'cms/comments',
                    'action' => 'cms.comments',
                    'show' => 1,
                ],
                [
                    'name' => 'Approve',
                    'url' => 'cms/comments/approve',
                    'action' => 'cms.comments.approve',
                    'show' => 0,
                ],
                [
                    'name' => 'Delete',
                    'url' => 'cms/comments/delete',
                    'action' => 'cms.comments.delete',
                    'show' => 0,
                ],
            
            ],
        ],
    ],

];
