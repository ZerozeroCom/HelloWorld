<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSmsDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_lists', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->string('smscode',10)->nullable();
            $table->text('keep')->nullable();
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->dropUnique(['name']);
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
            $table->dropColumn('keep');
            $table->dropColumn('smscode');
            $table->dropColumn('status');
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->string('name', 40)->unique()->change();
        });
    }
}
