<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id');
            $table->string('name',1000);
            $table->string('details',4000);
            $table->string('catagori');
            $table->string('unit');
            $table->string('delivary');
            $table->string('veriant')->nullable();
            $table->string('img')->nullable();
            $table->string('sold')->nullable();
            $table->string('active')->nullable();
            $table->string('special')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
