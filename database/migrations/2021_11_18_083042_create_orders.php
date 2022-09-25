<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id',20)->unique();
            $table->string('product_id',20);
            $table->string('veriant',20);
            $table->string('total_price',20);
            $table->string('btc_price',20)->nullable();
            $table->string('xmr_price',20)->nullable();
            $table->string('payment_type')->default('btc');
            $table->string('placed',2);
            $table->string('status',10);
            $table->string('address')->nullable();
            $table->string('sendto',2000)->nullable();
            $table->string('mykey',400)->nullable();
            $table->string('confirmation',10)->nullable();
            $table->text('shipmessage')->nullable();
            $table->text('message')->nullable();
            $table->string('user');
            $table->string('review')->nullable();

            $table->timestamps();

            //ALTER TABLE `orders` ADD `xmr_price` VARCHAR(20) NULL DEFAULT NULL AFTER `btc_price`, ADD `payment_type` VARCHAR(20) NOT NULL DEFAULT 'btc' AFTER `xmr_price`;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
