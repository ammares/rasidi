<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropLegalPageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('legal_pages');
        Schema::dropIfExists('legal_pages_translations');
        Schema::dropIfExists('legal_page_translations');
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
    }
}
