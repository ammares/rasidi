<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameHowItWorksIdColumnInIntroductionTranslationToIntoductionId extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('introduction_translations', function (Blueprint $table) {
            $table->renameColumn('how_it_works_id', 'introduction_id');
        });
        Schema::enableForeignKeyConstraints();
    }
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('introduction_translations', function (Blueprint $table) {
            $table->renameColumn('introduction_id', 'how_it_works_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}
