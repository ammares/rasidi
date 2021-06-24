<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowItWorksTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('how_it_works_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('how_it_works_id');
            $table->foreign('how_it_works_id')->references('id')->on('how_it_works')->onDelete('no action')->onUpdate('no action');
            $table->string('locale', 5)->index();
            $table->string('title', 191);
            $table->mediumText('summary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('how_it_works_translations');
    }
}
