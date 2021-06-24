<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropClientSecretAndStatusColumnsFromClientGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_gateways', function (Blueprint $table) {
            $table->dropColumn(['client_secret', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_gateways', function (Blueprint $table) {
            $table->string('client_secret', 45);
            $table->string('status', 191)->nullable();
        });
    }
}
