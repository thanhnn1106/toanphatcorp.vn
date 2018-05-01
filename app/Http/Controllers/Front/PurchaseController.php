<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use NL_MicroCheckout;
use App\Models\Packages;
use Illuminate\Support\Facades\Redis;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\PurchaseHistory;


class PurchaseController extends BaseController
{
    public function send(Request $request)
    {
        try {
            if ( ! $request->ajax()) {
                throw new \Exception();
            }

            $user = \Auth::user();

            $packageId = $request->get('packageId');
            $params    = array('status' => config('site.package_status.value.active'));
            $package   = Packages::getPackageById($packageId, $params);

            if ($package === NULL) {
                throw new \Exception();
            }

            $inputs = array(
                'receiver'                  => config('budget.service.email_receiver'),
                'order_code'                => sprintf(config('site.order_format'), $user->id, date('His-dmY')),
                'amount'                    => $package->price,
                'currency_code'             => 'vnd',
                'tax_amount'                => '0',
                'discount_amount'           => '0',
                'fee_shipping'              => '0',
                'request_confirm_shipping'  => '0',
                'no_shipping'               => '1',
                'return_url'                => route('front.purchase.success'),
                'cancel_url'                => route('front.home'),
                'language'                  => 'vi',
            );

            $obj = new NL_MicroCheckout(
                config('budget.service.merchant_code'),
                config('budget.service.merchant_pass'),
                config('budget.service.merchant_url_connect')
            );

            $result = $obj->setExpressCheckoutPayment($inputs);
            if ($result != false) {
                if ($result['result_code'] == '00') {

                    $inputs['package_id']    = $packageId;
                    $inputs['package_name']  = $package->name;
                    $inputs['package_month'] = $package->number_month;
                    $paymentMethod           = PaymentMethod::where('type', 'budget')->first();
                    $inputs['payment_method_id'] = ($paymentMethod !== NULL) ? $paymentMethod->id : 0;
                    Redis::hmset('user:'.$user->id.':buy', $inputs);

                    return response()->json(array('error' => 0, 'result' => array('urlResult' => $result['link_checkout'])));
                } else {
                    return response()->json(array('error' => 1, 'result' => $result['result_description']));
                }
            } else {
                return response()->json(array('error' => 1, 'result' => 'Lỗi kết nối tới cổng thanh toán Ngân Lượng'));
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());exit;
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

            $message = '';
            if ($result != false) {
                if ($result['result_code'] === '00') {

                    $this->_savePurchaseHistory($request, $result);

                    return redirect()->route('front.account');
                }
                $message = 'Mã lỗi '.$result['result_code'].' ('.$result['result_description'].') ';
            } else {
                $message = 'Lỗi kết nối tới cổng thanh toán Ngân Lượng';
            }
        } else {
            $message = 'Tham số truyền không đúng';
        }
        $data = [
            'message' => $message,
            'categories' => Category::all(),
        ];

        return view('front.purchase.error', $data);
    }

    private function _savePurchaseHistory($request, $result)
    {
        $user      = \Auth::user();
        $info      = Redis::hgetall('user:'.$user->id.':buy');
        $orderCode = $request->get('order_code');
        $now       = date('Y-m-d H:i:s');

        $data = array(
            'user_id' => $user->id,
            'package_id' => $info['package_id'],
            'package_name' => $info['package_name'],
            'package_month' => $info['package_month'],
            'payment_method_id' => $info['payment_method_id'],
            'order_code' => $orderCode,
            'merchant_site_code' => $result['merchant_site_code'],
            'transaction_id' => $result['transaction_id'],
            'transaction_type' => $result['transaction_type'],
            'transaction_status' => $result['transaction_status'],
            'price' => $result['amount'],
            'buyer_name' => $result['payer_name'],
            'buyer_email' => $result['payer_email'],
            'buyer_phone' => $result['payer_mobile'],
            'payment_method_name' => $result['method_payment_name'],
            'created_at' => $now,
        );

        PurchaseHistory::create($data);

        $expiredDate = $now;
        if ( ! empty($user->expired_date)) {
            $expiredDate = $user->expired_date;
        }
        $user->purchase_date = $now;
        $user->expired_date  = date('Y-m-d H:i:s', strtotime($expiredDate . '+'.$info['package_month'].' day'));
        $user->save();
    }
}