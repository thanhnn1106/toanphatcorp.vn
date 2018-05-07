<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\BaseController;
use Illuminate\Http\Request;
use NL_CheckOutV3;
use App\Models\Packages;
use Illuminate\Support\Facades\Redis;
use App\Models\Category;
use App\Models\PurchaseHistory;


class PurchaseController extends BaseController
{
    public function send(Request $request)
    {
        $packageId     = $request->get('packageId');
        $paymentMethod = $request->get('paymentMethod');

        $params    = array('status' => config('site.package_status.value.active'));
        $package   = Packages::getPackageById($packageId, $params);

        if ($package === NULL) {
            $request->session()->flash('error', 'Package not found. Please try again');
            return redirect()->route('front.package');
        }

        $const = config('site.payment_method.value');
        if ( ! isset($const[$paymentMethod])) {
            $request->session()->flash('error', 'Do not support that payment method. Please confirm with administrator');
            return redirect()->route('front.package');
        }

        $items = array(
            array(
                'item_name1'     => $package->name,
                'item_quantity1' => 1,
                'item_amount1'   => $package->price,
            ),
        );

        $orderDescription     = '';
        $buyerFullname        = '';
        $buyerEmail           = '';
        $buyerMobile          = '';
        $buyerAddress         = '';
        $bankCode             = '';
        $inputs = array(
            'order_code'      => sprintf(config('site.order_format'), $this->user->id, date('His-dmY')),
            'total_amount'    => $package->price,
            'tax_amount'      => 0,
            'discount_amount' => 0,
            'free_shipping'   => 0,
            'return_url'      => route('front.purchase.success'),
            'cancel_url'      => route('front.home'),
            'transaction_type'=> config('site.transaction_type.value.payment_now'),
            'tax_amount'      => 0,
        );

        $nlCheckout = new NL_CheckOutV3(
            config('budget.service.merchant_code'),
            config('budget.service.merchant_pass'),
            config('budget.service.email_receiver'),
            config('budget.service.merchant_url_connect')
        );

        if ($paymentMethod === $const['VISA']) {

            $result = $nlCheckout->VisaCheckout(
                $inputs['order_code'],
                $inputs['total_amount'],
                $inputs['transaction_type'],
                $orderDescription,
                $inputs['tax_amount'],
                $inputs['free_shipping'],
                $inputs['discount_amount'],
                $inputs['return_url'],
                $inputs['cancel_url'],
                $buyerFullname,
                $buyerEmail,
                $buyerMobile,
                $buyerAddress,
                $items,
                $bankCode
            );
        } else {

            $result = $nlCheckout->IBCheckout(
                $inputs['order_code'],
                $inputs['total_amount'],
                $bankCode,
                $inputs['transaction_type'],
                $orderDescription,
                $inputs['tax_amount'],
                $inputs['free_shipping'],
                $inputs['discount_amount'],
                $inputs['return_url'],
                $inputs['cancel_url'],
                $buyerFullname,
                $buyerEmail,
                $buyerMobile,
                $buyerAddress,
                $items
            );
        }
        if ($result->error_code == '00') {
            $inputs['package_id']    = $packageId;
            $inputs['package_name']  = $package->name;
            $inputs['package_month'] = $package->number_days;
            $inputs['payment_gate']  = config('site.payment_gate.value.budget');
            Redis::hmset('user:'.$this->user->id.':buy', $inputs);

            return Redirect::to($result->checkout_url);

        }
        $request->session()->flash('error', $result->error_message);
        return redirect()->route('front.package');
    }

    public function success(Request $request)
    {
        $obj = new NL_CheckOutV3(
            config('budget.service.merchant_code'),
            config('budget.service.merchant_pass'),
            config('budget.service.email_receiver'),
            config('budget.service.merchant_url_connect')
        );

        $token   = $request->get('token', NULL);
        $result  = $obj->GetTransactionDetail($token);
        $message = '';

        if ($result) {

            $errorCode           = (string)$result->error_code;
            $transactionStatus   = (string)$result->transaction_status;

            if ($errorCode === '00') {
                if ($transactionStatus === '00') {

                    $this->_savePurchaseHistory($request, $result);

                    return redirect()->route('front.account');
                }
            } else {
                $message = $result->GetErrorMessage($errorCode);
            }
        } else {
            $message = 'Tham số truyền không đúng';
        }
        $data = [
            'message' => $message,
        ];

        return view('front.purchase.error', $data);
    }

    private function _savePurchaseHistory($request, $result)
    {
        $info      = Redis::hgetall('user:'.$this->user->id.':buy');
        $orderCode = $request->get('order_code');
        $now       = date('Y-m-d H:i:s');

        $data = array(
            'user_id' => $this->user->id,
            'package_id' => $info['package_id'],
            'package_name' => $info['package_name'],
            'package_days' => $info['package_days'],
            'payment_gate' => $info['payment_gate'],
            'order_code' => $orderCode,
            'transaction_id' => $result['transaction_id'],
            'transaction_type' => $result['payment_type'],
            'transaction_status' => $result['transaction_status'],
            'price' => $result['total_amount'],
            'buyer_name' => $result['buyer_fullname'],
            'buyer_email' => $result['buyer_email'],
            'buyer_phone' => $result['buyer_mobile'],
            'buyer_address' => $result['buyer_address'],
            'payment_method' => $result['payment_method'],
            'created_at' => $now,
        );

        PurchaseHistory::create($data);

        // Increase time expire when user payment success
        $expiredDate = $now;
        if ( ! empty($this->user->expired_date)) {
            $expiredDate = $this->user->expired_date;
        }
        $this->user->purchase_date = $now;
        $this->user->expired_date  = date('Y-m-d H:i:s', strtotime($expiredDate . '+'.$info['package_days'].' day'));
        $this->user->save();

        // Remove hash key from memcache
        Redis::hDel('user:'.$this->user->id.':buy');
    }
}