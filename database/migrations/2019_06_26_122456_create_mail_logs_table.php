<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('mail_logs');
        Schema::create('mail_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('email_template_id');
            $table->foreign('email_template_id')->references('id')->on('email_templates')->onDelete('no action')->onUpdate('no action');
            $table->string('subject')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('sent_status', 50)->nullable();
            $table->text('meta')->nullable();
            $table->text('notify_to');
            $table->string('notify_by')->default('email');
            $table->string('fired_type')->nullable();
            $table->integer('fired_id')->unsigned()->nullable();
            $table->timestamp('fired_at')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mail_logs');
    }
}
