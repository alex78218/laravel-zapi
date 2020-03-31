<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('power_name',64)->default('')->after('id');
            $table->string('module',64)->default('')->after('id');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->string('remark')->default('')->after('name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('power_name');
            $table->dropColumn('module');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('remark');
        });
    }
}
