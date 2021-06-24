<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_template_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('email_template_id');
            $table->foreign('email_template_id')->references('id')->on('email_templates')->onDelete('no action')->onUpdate('no action');
            $table->string('locale', 5)->index();
            $table->string('subject', 191);
            $table->mediumText('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_template_translations');
    }
}
