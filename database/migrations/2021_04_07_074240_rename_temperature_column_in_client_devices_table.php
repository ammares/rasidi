<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTemperatureColumnInClientDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_devices', function (Blueprint $table) {
            $table->renameColumn('temprature', 'temperature');
            $table->string('identifier', 100)->nullable()->change();
            $table->unsignedInteger('gateway_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_devices', function (Blueprint $table) {
            $table->renameColumn('temperature', 'temprature');
            $table->string('identifier', 100)->change();
            $table->unsignedInteger('gateway_id')->change();
        });
    }
}
