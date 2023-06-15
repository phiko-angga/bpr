<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPostcategoryPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tb_postcategory_pages')) {
            Schema::create('tb_postcategory_pages', function (Blueprint $table) {
                $table->id();
                $table->integer('postcategory_id')->length(11);
                $table->integer('page_id')->length(11);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_postcategory_pages');
    }
}
