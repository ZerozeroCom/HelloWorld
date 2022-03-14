<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamp('sms_sendtime');
            $table->foreignId('device_id')->constrained('devices');
            $table->string('name');
            $table->string('sms_content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_lists');
    }
}
