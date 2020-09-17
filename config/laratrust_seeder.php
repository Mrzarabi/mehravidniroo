<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'owner' => [
            'user' => 'r,d',
            'category' => 'c,r,u,d',
            'product' => 'c,r,u,d',
            'image' => 'c,r,u,d',
            'ticket' => 'c,r,u,d',
            'comment' => 'c,r,u,d,a',
        ],
        
        'user' => [
            'user' => 'r,u',
            'category' => 'r',
            'product' => 'r',
            'image' => 'r',
            'ticket' => 'c,r',
            'comment' => 'c,r',
        ],
        
        'customer' => [
            'category' => 'r',
            'product' => 'r',
            'image' => 'r',
        ],
        // 'administrator' => [
        //     'users' => 'c,r,u,d',
        //     'profile' => 'r,u'
        // ],
        // 'user' => [
        //     'profile' => 'r,u',
        // ],
        // 'role_name' => [
        //     'module_1_name' => 'c,r,u,d',
        // ]
    ],
    'permissions_label' => [
        'user' => 'کاربر',
        'ticket'  => 'تیکت ها',
        
        'comment' => 'نظرات',
        
        'category' => 'دسته بندی محصولات',
        'product' => 'محصول',
        
        'role' => 'نقش',

        // 'setting' => 'تنظیمات'
    ],
    'actions_label' => [
        'create'            => 'ثبت',
        'read'              => 'مشاهده',
        'update'            => 'ویرایش',
        'delete'            => 'حذف',
        'accept'            => 'تایید/رد کزدن',
        // 'active'            => 'فعال/غیرفعال کزدن',
        // 'see-details'       => 'مشاهده جزییات',
        // 'see-creator'       => 'مشاهده ثبت کننده',
        // 'close'             => 'بستن',
        // 'answer'            => 'پاسخ دادن'
        // 'add-item'          => 'افزودن به',
        // 'remove-item'       => 'حذف از',
        // 'see-log'           => 'مشاهده لاگ تغییرات',
        // 'see-address'       => 'مشاهده آدرس',
        // 'see-phone-number'  => 'مشاهده شماره تلفن',
        // 'see-items'         => 'مشاهده اقلام',
        // 'change-status'     => 'تغییر وضعیت'
        // 'see-inventory'     => 'مشاهده موجودی',
    ],
    'roles_label' => [
        'owner' => [
            'name' => 'مدیر',
            'description' => 'مالک وبسایت'
        ],
        'smaat_supporter' => [
            'name'  => 'پشتیبان',
            'description' => 'کسی که پشتیبانی این پروژه رو بر عهده داره'
        ],
        'user' => [
            'name'  => 'مشتریان ویژه',
            'description' => 'مشتریان ویژه این فروشگاه هستند'
        ],
        'customer' => [
            'name'  => 'مشتریان عادی',
            'description' => 'مشتریان عادی این فروشگاه هستند'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'a' => 'accept',
    ]
];
