<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('categoria')->default('Pacotes');
            $table->string('tipo')->default('Tranquilo');
            $table->boolean('situacao')->default(true);
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('categoria');
            $table->dropColumn('tipo');
            $table->dropColumn('situacao');
        });
    }
}
