<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('no action')->onUpdate('no action');
            $table->unsignedInteger('gateway_id');
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('no action')->onUpdate('no action');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('no action')->onUpdate('no action');
            $table->string('identifier', 100);
            $table->string('label', 191)->nullable();
            $table->char('connected', 1)->default(1);
            $table->double('power')->nullable();
            $table->double('temprature')->nullable();
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
        Schema::dropIfExists('client_devices');
    }
}
