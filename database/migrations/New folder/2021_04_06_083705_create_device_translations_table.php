<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('title');
        });
        Schema::create('device_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('no action')->onUpdate('no action');
            $table->string('locale', 5)->index();
            $table->string('title', 191);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_translations');
        Schema::table('devices', function (Blueprint $table) {
            $table->string('title', 191)->nullable()->after('id');
        });
    }
}
