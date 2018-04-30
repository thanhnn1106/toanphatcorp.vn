<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use NL_MicroCheckout;


class PurchaseController extends BaseController
{
    public function send(Request $request)
    {
        $items = array(
            array(
                'item_name' => 'Package 1 thang',
                'item_quanty' => 1,
                'item_amount' => 1,
            ),
        );
        $inputs = array(
            'receiver'	=> config('budget.service.email_receiver'),
            'order_code'	=> 'Đơn hàng-'.date('His-dmY'),
            'amount'		=> 2000000,
            'currency_code'	=> 'vnd',
            'tax_amount'	=> '0',
            'discount_amount'	=> '0',
            'fee_shipping'	=> '0',
            'request_confirm_shipping'	=> '0',
            'no_shipping'	=> '1',
            'return_url'	=> route('front.purchase.success'),
            'cancel_url'	=> route('front.purchase.cancel'),
            'language'		=> 'vi',
            'items'		=> $items
        );

	$obj = new NL_MicroCheckout(config('budget.service.merchant_code'), config('budget.service.merchant_pass'), config('budget.service.merchant_url_connect'));
	$result = $obj->setExpressCheckoutPayment($inputs);
        echo '<pre>';print_r($result);exit;

        $data = array();

        return view('front.home.index', $data);
    }
}