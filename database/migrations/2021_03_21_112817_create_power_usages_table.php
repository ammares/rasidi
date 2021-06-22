<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_usages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_gateway_id');
            $table->foreign('client_gateway_id')->references('id')->on('client_gateways')->onDelete('no action')->onUpdate('no action');
            $table->double('power')->nullable();
            $table->double('voltage')->nullable();
            $table->double('frequency')->nullable();
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
        Schema::dropIfExists('power_usages');
    }
}
