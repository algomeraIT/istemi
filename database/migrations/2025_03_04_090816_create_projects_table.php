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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key         
            $table->string('estimate');
            $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
            $table->unsignedBigInteger('id_chief_area')->nullable();
            $table->unsignedBigInteger('id_chief_project')->nullable();
            $table->string('current_phase')->nullable();
            $table->string('client_name')->nullable();
            $table->string('logo_path_client')->nullable();
            $table->text('note_client')->nullable();
            $table->string('responsible')->nullable();
            $table->string('address_client');
            $table->string('client_status');
            $table->text('note')->nullable();
            $table->text('general_info')->nullable();
            $table->string('n_file')->nullable();
            $table->string('name_project');
            $table->string('client_type')->nullable();
            $table->boolean('is_from_agent')->default(false)->nullable();
            $table->string('chief_area')->nullable();
            $table->string('chief_project')->nullable();
            $table->decimal('total_budget', 15, 2)->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->decimal('starting_price', 15, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->decimal('discounted', 15, 2)->nullable();
            $table->integer('n_firms')->nullable();
            $table->text('firms_and_percentage')->nullable();
            $table->text('goals')->nullable();
            $table->text('project_scope')->nullable();
            $table->text('expected_results')->nullable();
            $table->json('stackholder_id')->nullable();
            $table->unsignedBigInteger('phase_id')->nullable();
            $table->string('status');
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
