<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDeviceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_device_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_device_id');
            $table->foreign('client_device_id')->references('id')->on('client_devices')->onDelete('no action')->onUpdate('no action');
            $table->char('connected', 1)->default(1);
            $table->double('temprature')->nullable();
            $table->double('power')->nullable();
            $table->string('command', 45)->nullable();
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
        Schema::dropIfExists('client_device_logs');
    }
}
