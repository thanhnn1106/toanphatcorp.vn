<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model  {

    const PAYMENT_METHOD_FOREIGN_KEY = 'payment_method_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments_method';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type',
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

    public function purchases()
    {
        return $this->hasMany('App\Models\PurchaseHistory', 'id', 'payment_method_id');
    }

}