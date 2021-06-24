<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDeviceSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_device_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('demand_request_id');
            $table->foreign('demand_request_id')->references('id')->on('demand_requests')->onDelete('no action')->onUpdate('no action');
            $table->unsignedInteger('client_device_id');
            $table->foreign('client_device_id')->references('id')->on('client_devices')->onDelete('no action')->onUpdate('no action');
            $table->date('date')->nullable();
            $table->integer('hour');
            $table->char('connected', 1)->nullable();
            $table->dateTime('completed_at')->nullable();
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
        Schema::dropIfExists('client_device_schedules');
    }
}
