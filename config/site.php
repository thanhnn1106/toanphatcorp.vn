<?php
define('LIMIT_ROW', 10);
define('LIMIT_FRONT_ROW', 16);
define('LIMIT_ROW_AJAX', 30);
define('ROLE_ADMIN', 'administrator');
define('ROLE_MANAGE', 'manage');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
define('VERSION', '1.2');
define('DATE_FORMAT', 'Y-m-d');
return [
    'roles' => array(
        'administrator' => 1,
        'manage'        => 2,
    ),
    'user_status' => array(
        'label' => array(
            1 => 'Đang hoạt động',
            0 => 'Đang khoá',
        ),
        'value' => array(
            'active'   => 1,
            'inactive' => 0
        ),
    ),
    'type_download' => array(
        'label' => array(
            1 => 'Premium',
            0 => 'Normal',
        ),
        'value' => array(
            'premium'   => 1,
            'normal' => 0
        ),
    ),
    'file_status' => array(
        'label' => array(
            1 => 'Active',
            0 => 'Inactive',
        ),
        'value' => array(
            'active'   => 1,
            'inactive' => 0
        ),
    ),
    'package_status' => array(
        'label' => array(
            1 => 'Active',
            0 => 'Inactive',
        ),
        'value' => array(
            'active'   => 1,
            'inactive' => 0
        ),
    ),
    'file_accept_types' => 'jpeg,png',
    'package_range_month' => array(
        '1' => 30,
        '3' => 90,
        '6' => 180,
        '12' => 365
    ),
];
