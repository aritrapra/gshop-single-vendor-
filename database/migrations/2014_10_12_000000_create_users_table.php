<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('memmonic',256)->nullable();
            $table->string('password',256);
            $table->float('balence');
            $table->string('security')->nullable();
            $table->string('temp_security',4000)->nullable();
            $table->string('pgp',4000)->nullable();
            $table->string('temp_pgp',4000)->nullable();
            $table->string('login_count')->nullable();
            $table->string('two_factor')->nullable();
            $table->string('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
