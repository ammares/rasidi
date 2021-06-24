<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteCityAndAddCityidInDemandRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('demand_requests', 'city')) {
            Schema::table('demand_requests', function (Blueprint $table) {$table->dropColumn('city');});
        }
        Schema::table('demand_requests', function (Blueprint $table) {
            $table->unsignedInteger('city_id')->nullable()->after('country_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('demand_requests', 'city_id')) {
            Schema::table('demand_requests', function (Blueprint $table) {
                $table->dropForeign('demand_requests_city_id_foreign');
                $table->dropColumn('city_id');
            });
        }
        Schema::table('demand_requests', function (Blueprint $table) {
            $table->string('city', 191)->nullable();
        });
    }
}
