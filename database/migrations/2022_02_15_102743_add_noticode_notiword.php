<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoticodeNotiword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_lists', function (Blueprint $table) {
            $table->string('keyword')->nullable();
            $table->boolean('noticode')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_lists', function (Blueprint $table) {
            $table->dropColumn('noticode');
            $table->dropColumn('keyword');
        });
    }
}
