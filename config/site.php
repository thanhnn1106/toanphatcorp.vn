<?php
define('LIMIT_ROW', 10);
define('LIMIT_ROW_AJAX', 30);
define('ROLE_ADMIN', 'administrator');
define('ROLE_MANAGE', 'manage');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
return [
    'roles' => array(
        'administrator' => 1,
        'manage'        => 2,
    ),
    'user_status' => array(
        'label' => array(
            1 => 'Active',
            0 => 'Inactive',
        ),
        'value' => array(
            'active'   => 1,
            'inactive' => 0
        ),
    ),
    'sex' => array(
        'label' => array(
            1 => 'front.register_page.sex.male',
            0 => 'front.register_page.sex.female',
        ),
        'value' => array(
            'male' => 1,
            'female' => 0
        ),
    ),
    'domain_name' => array(
        'local' => array(
            'thynh.allelua',
        ),
        'production' => array(
            'allelua.com',
        ),
    ),

    'general_logo' => array(
        'path_upload_logo' => '/uploads/logo',
    ),
    'product_image' => array(
        'resize_width' => 210,
        'resize_height' => 210,
        'resize_detail_width' => 83,
        'resize_detail_height' => 105,
        'resize_image' => 'w-resize-%s',
        'path_upload' => '/uploads/product/%s',
    ),
    'seller_personal_info_status' => array(
        'pending'  => 0,
        'approved' => 1,
    ),
    'order_status_name' => array(
        '0' => 'Chưa xử lý',
        '1' => 'Đã xử lý',
    ),
    'order_status_value' => array(
        'waiting_process' => 0,
        'processed'       => 1,
    ),
];