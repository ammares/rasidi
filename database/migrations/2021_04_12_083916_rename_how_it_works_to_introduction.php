<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameHowItWorksToIntroduction extends Migration
{
    public function up()
    {
        Schema::rename('how_it_works', 'introductions');
        Schema::rename('how_it_works_translations', 'introduction_translations');
    }
    public function down()
    {
        Schema::rename('introductions', 'how_it_works');
        Schema::rename('introduction_translations', 'how_it_works_translations');
    }
}
