<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('id_surat');
            $table->string('no_surat')->length('100');
            $table->string('dari')->length('40');
            $table->string('untuk')->length('40');
            $table->string('tujuan')->length('100');
            $table->mediumText('keterangan')->nullable();
            $table->timestamps();
            $table->string('dir')->nullable();
            $table->string('filename')->nullable()->length(50);
            $table->unsignedbigInteger('id_user');
            $table->unsignedbigInteger('id_category');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('tipe')->length('1');
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('cascade');
            $table->unsignedTinyInteger('delete')->length('1')->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuk');
    }
}
