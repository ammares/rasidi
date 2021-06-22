<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishTopicAndSubscribeTopicColumnsToClientGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_gateways', function (Blueprint $table) {
            $table->string('publish_topic', 50)->nullable()->after('client_secret');
            $table->string('subscribe_topic', 50)->nullable()->after('publish_topic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_gateways', function (Blueprint $table) {
            $table->dropColumn(['publish_topic', 'subscribe_topic']);
        });
    }
}
