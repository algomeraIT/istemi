<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusColumnTypeInAcquisitionsTable extends Migration
{
    public function up()
    {
        Schema::table('acquisitions', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('acquisitions', function (Blueprint $table) {
            $table->integer('status')->default(0); 
        });
    }

    public function down()
    {
        Schema::table('acquisitions', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('acquisitions', function (Blueprint $table) {
            $table->string('status')->default(''); 
        });
    }
}
