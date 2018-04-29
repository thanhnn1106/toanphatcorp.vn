<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPurchaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_purchase_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('package_id')->references('id')->on('packages_info')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('payment_method_id')->references('id')->on('payments_method')->onDelete('cascade')->onUpdate('cascade');
            $table->string('order_code', 100);
            $table->tinyInteger('order_type')->comments('Ngan luong: 1 = Thanh toan ngay, 2: thanh toan tam giu');
            $table->tinyInteger('status')-> comments('1: success, 0: in process, 2: fail');
            $table->decimal('price', 10, 0);
            $table->string('payment_method_name', 255);
            $table->string('buyer_name', 255);
            $table->string('buyer_email', 255);
            $table->string('buyer_phone', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_purchase_history');
    }
}
