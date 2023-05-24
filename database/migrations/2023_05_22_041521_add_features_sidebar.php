<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturesSidebar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_pages', function (Blueprint $table) {
            $table->string('features_sidebar',255)->nullable();
        });
        Schema::table('tb_post', function (Blueprint $table) {
            $table->string('features_sidebar',255)->nullable();
        });
        Schema::table('tb_post_category', function (Blueprint $table) {
            $table->string('features_sidebar',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
