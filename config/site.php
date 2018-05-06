<?php
define('LIMIT_ROW', 10);
define('LIMIT_FRONT_ROW', 16);
define('LIMIT_ROW_AJAX', 30);
define('ROLE_ADMIN', 'administrator');
define('ROLE_MANAGE', 'manage');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
define('VERSION', '1.2');
define('DATE_FORMAT', 'Y-m-d');
define('MAX_PREMIUM_FILE_DOWNLOAD', 2);
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
        '1'  => 30,
        '3'  => 90,
        '6'  => 180,
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
            00 => 'Đã thanh toán',
            01 => 'Đã thanh toán, chờ xử lý',
            02 => 'Chưa thanh toán',
        ),
        'value' => array(
            'paid'          => 00,
            'payment_wait'  => 01,
            'not_yet'       => 02,
        ),
    ),
    'faqs_status' => array(
        'label' => array(
            1 => 'Hiển thị',
            0 => 'Không hiển thị'
        ),
        'value' => array(
            'active'   => 1,
            'inactive' => 0
        ),
    ),
    'tags_status' => array(
        'value' => array(
            'is_popular'   => 1,
            'is_not_popular' => 0
        ),
        'label' => array(
            1 => 'Phổ biến',
            0 => 'Không phổ biến'
        )
    ),
    'payment_gate' => array(
        'label' => array(
            'budget' => 'Ngân Lượng',
        ),
        'value' => array(
            'budget'   => 'budget',
        ),
    ),
    'payment_method' => array(
        'label' => array(
            'VISA'          => 'Thanh toán bằng thẻ Visa, Master Card',
            'IB_ONLINE'     => 'Thanh toán bằng internet banking',
        ),
        'value' => array(
            'VISA'          => 'VISA',
            'IB_ONLINE'     => 'IB_ONLINE'
        ),
    ),
    'bank_code' => array(
        'label' => array(
            'VCB' => 'Ngân hàng TMCP Ngoại Thương Việt Nam (Vietcombank)',
            'DAB' => 'Ngân hàng TMCP Đông Á (DongA Bank)',
            'TCB' => 'Ngân hàng TMCP Kỹ Thương (Techcombank)',
            'MB'  => 'Ngân hàng TMCP Quân Đội (MB)',
            'VIB' => 'Ngân hàng TMCP Quốc tế (VIB)',
            'ICB' => 'Ngân hàng TMCP Công Thương (VietinBank)',
            'EXB' => 'Ngân hàng TMCP Xuất Nhập Khẩu (Eximbank)',
            'ACB' => 'Ngân hàng TMCP Á Châu (ACB)',
            'HDB' => 'Ngân hàng TMCP Phát Triển Nhà TP. Hồ Chí Minh (HDBank)',
            'MSB' => 'Ngân hàng TMCP Hàng Hải (MariTimeBank)',
            'NVB' => 'Ngân hàng TMCP Nam Việt (NaviBank)',
            'VAB' => 'Ngân hàng TMCP Việt Á (VietA Bank)',
            'VPB' => 'Ngân hàng TMCP Việt Nam Thịnh Vượng  (VPBank)',
            'SCB' => 'Ngân hàng TMCP Sài Gòn Thương Tính (Sacombank)',
            'GPB' => 'Ngân hàng TMCP Dầu Khí (GPBank)',
            'AGB' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn (Agribank)',
            'BIDV' => 'Ngân hàng Đầu tư và Phát triển Việt Nam (BIDV)',
            'OJB' => 'Ngân hàng TMCP Đại Dương (OceanBank)',
            'PGB' => 'Ngân Hàng TMCP Xăng Dầu Petrolimex (PGBank)',
            'SHB' => 'Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)',
            'TPB' => 'Ngân hàng TMCP Tiên Phong (TienPhong Bank)',
            'NAB' => 'Ngân hàng Nam Á',
            'SGB' => 'Ngân hàng Sài Gòn Công Thương',
        ),
    ),
];
