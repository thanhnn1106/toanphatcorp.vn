<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use NL_MicroCheckout;
use App\Models\Packages;


class PurchaseController extends BaseController
{
    public function send(Request $request)
    {
        try {
            if ( ! $request->ajax()) {
                throw new \Exception();
            }

            $packageId = $request->get('packageId');
            $params    = array('status' => config('site.package_status.value.active'));
            $row       = Packages::getPackageById($packageId, $params);

            if ($row === NULL) {
                throw new \Exception();
            }
            $items = array(
                array(
                    'item_name' => $row->name,
                    'item_quanty' => 1,
                    'item_amount' => $row->price,
                ),
            );
            $inputs = array(
                'receiver'                  => config('budget.service.email_receiver'),
                'order_code'                => 'package-order-'.date('His-dmY'),
                'amount'                    => $row->price,
                'currency_code'             => 'vnd',
                'tax_amount'                => '0',
                'discount_amount'           => '0',
                'fee_shipping'              => '0',
                'request_confirm_shipping'  => '0',
                'no_shipping'               => '1',
                'return_url'                => route('front.purchase.success'),
                'cancel_url'                => route('front.purchase.cancel'),
                'language'                  => 'vi',
                'items'                     => $items
            );

            $obj = new NL_MicroCheckout(
                config('budget.service.merchant_code'),
                config('budget.service.merchant_pass'),
                config('budget.service.merchant_url_connect')
            );

            $result = $obj->setExpressCheckoutPayment($inputs);
            if ($result != false) {
                if ($result['result_code'] == '00') {
                    return response()->json(array('error' => 0, 'result' => array('urlResult' => $result['link_checkout'])));
                } else {
                    return response()->json(array('error' => 1, 'result' => $result['result_description']));
                }
            } else {
                return response()->json(array('error' => 1, 'result' => 'Lỗi kết nối tới cổng thanh toán Ngân Lượng'));
            }
        } catch (\Exception $e) {
            return response()->json(array('error' => 1, 'result' => trans('common.msg_error_exception_ajax')));
        }
    }

    public function success(Request $request)
    {
        $obj = new NL_MicroCheckout(
            config('budget.service.merchant_code'),
            config('budget.service.merchant_pass'),
            config('budget.service.merchant_url_connect')
        );

        if ($obj->checkReturnUrlAuto()) {
            $inputs = array(
                    'token' => $obj->getTokenCode(),
            );

            $result = $obj->getExpressCheckout($inputs);

            if ($result != false) {
                if ($result['result_code'] != '00') {
                    die('Mã lỗi '.$result['result_code'].' ('.$result['result_description'].') ');
                }
            } else {
                die('Lỗi kết nối tới cổng thanh toán Ngân Lượng');
            }
        } else {
            die('Tham số truyền không đúng');
        }
    }

    public function cancel(Request $request)
    {
        
    }
}