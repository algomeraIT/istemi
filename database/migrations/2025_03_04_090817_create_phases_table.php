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
        Schema::create('phases', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint in the 'projects' table before dropping the 'phases' table
        Schema::table('projects', function (Blueprint $table) {
            // Drop the foreign key constraint
            /* $table->dropForeign('projects_phase_id_foreign'); */
        });

        // Now drop the 'phases' table
        Schema::dropIfExists('phases');
    }
};