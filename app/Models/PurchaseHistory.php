<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_purchase_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        User::USER_FOREIGN_KEY,
        Packages::PACKAGE_FOREIGN_KEY,
        'order_code',
        'payment_gate',
        'transaction_id',
        'transaction_type',
        'transaction_status',
        'price',
        'package_name',
        'package_days',
        'bank_code',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'buyer_address',
        'card_type',
        'card_amount',
        'fee',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Packages', 'package_id');
    }

    public static function getList($params = array())
    {
        return PurchaseHistory::paginate(LIMIT_ROW);
    }

    public function getTransactionType()
    {
        $const = config('site.transaction_type.label');
        if (isset($const[$this->transaction_type])) {
            return $const[$this->transaction_type];
        }
        return '';
    }

    public function getTransactionStatus()
    {
        $const = config('site.transaction_status.label');
        if (isset($const[$this->transaction_type])) {
            return $const[$this->transaction_type];
        }
        return '';
    }

    public function getPaymentGate()
    {
        $const = config('site.payment_gate.label');
        if (isset($const[$this->payment_gate])) {
            return $const[$this->payment_gate];
        }
        return '';
    }

    public function getPaymentMethod()
    {
        $const = config('site.payment_method.label');
        if (isset($const[$this->payment_method])) {
            return $const[$this->payment_method];
        }
        return '';
    }

    public function getBank()
    {
        $const = config('site.bank_code.label');
        if (isset($const[$this->bank_code])) {
            return $const[$this->bank_code];
        }
        return '';
    }

}