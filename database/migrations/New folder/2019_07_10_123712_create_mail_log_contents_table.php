<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailLogContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mail_log_contents');
        Schema::create('mail_log_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->unsignedInteger('mail_log_id');
            $table->foreign('mail_log_id')->references('id')->on('mail_logs')->onDelete('no action')->onUpdate('no action');
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
        Schema::dropIfExists('mail_log_contents');
    }
}
