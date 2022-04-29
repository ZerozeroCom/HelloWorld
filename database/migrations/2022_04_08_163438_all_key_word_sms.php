<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllKeyWordsms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_lists', function (Blueprint $table) {
            $table->renameColumn('id', 'smsid');
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
            $table->renameColumn('smsid', 'id');
        });
    }
}
