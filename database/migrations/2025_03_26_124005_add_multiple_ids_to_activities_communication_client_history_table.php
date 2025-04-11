<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       /*  if (!Schema::hasColumn('activities_communication_client_history', 'id_assignee')) {
            Schema::table('activities_communication_client_history', function (Blueprint $table) {
                $table->unsignedBigInteger('id_assignee')->nullable();
            });
        }
        if (!Schema::hasColumn('activities_communication_client_history', 'id_knowledge')) {
            Schema::table('activities_communication_client_history', function (Blueprint $table) {
                $table->unsignedBigInteger('id_knowledge')->nullable();
            });
        }
        if (!Schema::hasColumn('activities_communication_client_history', 'id_answer')) {
            Schema::table('activities_communication_client_history', function (Blueprint $table) {
                $table->unsignedBigInteger('id_answer')->nullable();
            });
        }

        Schema::table('activities_communication_client_history', function (Blueprint $table) {
            $table->foreign('id_assignee')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_knowledge')->references('id')->on('knowledge')->onDelete('cascade');
            $table->foreign('id_answer')->references('id')->on('answers')->onDelete('cascade');
        }); */

    }
    
    public function down(): void
    {
    /*          Schema::table('activities_communication_client_history', function (Blueprint $table) {
            // Drop the foreign key constraints
            $table->dropForeign(['id_assignee']);
            $table->dropForeign(['id_knowledge']);
            $table->dropForeign(['id_answer']);
        });

        Schema::table('activities_communication_client_history', function (Blueprint $table) {
            // Drop the columns
            $table->dropColumn(['id_assignee', 'id_knowledge', 'id_answer']);
        }); */
    }
};
