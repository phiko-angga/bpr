<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageIdToTbMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_menu', function (Blueprint $table) {
            $table->integer('page_id')->length(11)->nullable()->after('id');
        });
        Schema::table('tb_site', function (Blueprint $table) {
            $table->string('logo_favicon',150)->nullable()->after('logo_footer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
