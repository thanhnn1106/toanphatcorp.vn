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
    'static_page_status' => array(
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
            1 => 'Đang hoạt động',
            0 => 'Đang khoá',
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
    'contact_status' => array(
        'label' => array(
            0 => 'Mới',
            1 => 'Đang xử lý',
            2 => 'Đã xử lý',
        ),
        'value' => array(
            'new'   => 0,
            'process' => 1,
            'solved' => 2
        )
    ),
    'order_format' => 'buy-%d-%s',
    'transaction_type' => array(
        'label' => array(
            1 => 'Thanh toán ngay',
            2 => 'Thanh toán tạm giữ',
        ),
        'value' => array(
            'payment_now'   => 1,
            'payment_wait'  => 2
        ),
    ),
    'transaction_status' => array(
        'label' => array(
            1 => 'Chưa thanh toán',
            2 => 'Đã thanh toán, tiền đang tạm giữ',
            3 => 'Giao dịch lỗi',
            4 => 'Đã thanh toán',
        ),
        'value' => array(
            'waiting'   => 1,
            'payment_wait'  => 2,
            'error'  => 3,
            'done'  => 4,
        ),
    ),
];
