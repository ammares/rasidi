<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertUserRoleToRoleIdLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('login_logs', function (Blueprint $table) {
            $table->dropColumn(['username', 'user_role', 'note']);
            $table->unsignedBigInteger('role_id')->after('user_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('login_logs', function (Blueprint $table) {
            $table->string('username')->after('id');
            $table->string('note')->after('user_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('login_logs', function (Blueprint $table) {
            $table->string('user_role');
            $table->dropForeign('login_logs_role_id_foreign');
            $table->dropColumn('role_id');
        });
    }
}
