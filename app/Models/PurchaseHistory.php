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
        PaymentMethod::PAYMENT_METHOD_FOREIGN_KEY,
        'order_code',
        'order_type',
        'status',
        'price',
        'payment_method_name',
        'buyer_name',
        'buyer_email',
        'buyer_phone'
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

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Packages', 'package_id');
    }

}