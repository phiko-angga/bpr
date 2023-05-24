<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50);
            $table->string('alamat',150);
            $table->string('telp',15);
            $table->string('email',40);
            $table->string('pesan',250);
            $table->integer('read')->length(1)->default(0);
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
        Schema::dropIfExists('tb_pengajuan');
    }
}
