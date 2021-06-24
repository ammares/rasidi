<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('no action')->onUpdate('no action');
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('no action')->onUpdate('no action');
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191);
            $table->string('password', 191);
            $table->string('mobile', 45);
            $table->string('longitude', 45)->nullable();
            $table->string('latitude', 45)->nullable();
            $table->string('city', 191)->nullable();
            $table->double('solar_pv')->nullable();
            $table->double('battery_storage')->default(0);
            $table->char('active', 1)->default(1);
            $table->char('ban', 1)->default(0);
            $table->char('email_verified', 1)->default(0);
            $table->string('email_verification_code')->nullable();
            $table->timestamp('email_expired_at')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
