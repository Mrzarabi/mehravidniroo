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
        '100e82ba-e1c0-4153-8633-e1bd228f7399' => [
            'user' => 'r,d',
            'category' => 'c,r,u,d',
            'product' => 'c,r,u,d',
            'image' => 'c,r,u,d',
            'ticket' => 'c,r,u,d',
            'comment' => 'c,r,u,d,a',
        ],
        
        '3362c127-65aa-4950-b14f-2fc86b53ea88' => [
            'user' => 'r,u',
            'category' => 'r',
            'product' => 'r',
            'image' => 'r',
            'ticket' => 'c,r',
            'comment' => 'c,r',
        ],

        '40dd0ea1-c598-47f7-b138-a8055f0b5c64' => [
            'user' => 'r,u',
            'category' => 'r',
            'product' => 'r',
            'image' => 'r',
            'ticket' => 'c,r',
            'comment' => 'c,r',
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
        '100e82ba-e1c0-4153-8633-e1bd228f7399' => [
            'name' => 'مدیر',
            'description' => 'مالک وبسایت'
        ],
        '3362c127-65aa-4950-b14f-2fc86b53ea88' => [
            'name'  => 'مشتریان ویژه',
            'description' => 'مشتریان ویژه این فروشگاه هستند'
        ],
        '40dd0ea1-c598-47f7-b138-a8055f0b5c64' => [
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
