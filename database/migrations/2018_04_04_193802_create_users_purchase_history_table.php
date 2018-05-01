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
            $table->string('merchant_site_code', 100);
            $table->string('transaction_id', 100);
            $table->tinyInteger('transaction_type')->comments('Ngan luong: 1 = Thanh toan ngay, 2: thanh toan tam giu');
            $table->tinyInteger('transaction_status')-> comments('1: chua thanh toan, 2: da thanh toan - dang tam giu, 3: giao dich loi, 4: danh thanh toan, chuyen vao tai khoan nguoi ban');
            $table->decimal('price', 10, 0);
            $table->string('package_name', 255);
            $table->integer('package_month')->nullable();
            $table->string('payment_method_name', 255);
            $table->string('buyer_name', 255)->nullable();
            $table->string('buyer_email', 255)->nullable();
            $table->string('buyer_phone', 100)->nullable();
            $table->string('card_type', 100)->nullable();
            $table->integer('card_amount')->nullable();
            $table->integer('fee')->nullable();
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
