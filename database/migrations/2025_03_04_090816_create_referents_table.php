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
        Schema::create('referents', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->string('name');
            $table->string('last_name');
            $table->string('title')->nullable();
            $table->string('job_position')->nullable();
            $table->string('email');
            $table->string('telephone');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('estimates')) {
            Schema::table('estimates', function (Blueprint $table) {
                if (Schema::hasColumn('estimates', 'referent_id')) {
                    $table->dropForeign(['referent_id']);
                    $table->dropColumn('referent_id');
                }
            });
        }
    
        Schema::dropIfExists('referents');
    }
};
