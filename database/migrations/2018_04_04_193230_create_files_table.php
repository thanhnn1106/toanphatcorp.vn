<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('track_list');
            $table->integer('type_download')->comment('0=normal, 0=premium');
            $table->integer('status')->comment('0=inactive, 0=active');
            $table->text('thumbnail');
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
        Schema::dropIfExists('files_info');
    }
}
