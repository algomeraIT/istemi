<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('id_chief_area')->nullable()->after('id_client');
            $table->unsignedBigInteger('id_chief_project')->nullable()->after('id_chief_area');

            $table->foreign('id_chief_area')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_chief_project')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['id_chief_area']);
            $table->dropForeign(['id_chief_project']);
            $table->dropColumn(['id_chief_area', 'id_chief_project']);
        });
    }
};
