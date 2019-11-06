<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id_user');
            $table->string('name')->length(30);
            $table->string('alamat')->length(40);
            $table->string('no_telp')->length(13);
            $table->string('email')->unique();
            $table->string('dir')->nullable();
            $table->string('filename')->nullable()->length(50);
            $table->string('password');
            $table->unsignedBigInteger('id_hak_akses')->nullable();
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
