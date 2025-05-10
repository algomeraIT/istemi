<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'general_info')) {
                $table->text('general_info')->nullable();
            }

            if (!Schema::hasColumn('projects', 'n_file')) {
                $table->string('n_file')->nullable();
            }

            if (!Schema::hasColumn('projects', 'name_project')) {
                $table->string('name_project');
            }

            if (!Schema::hasColumn('projects', 'client_name')) {
                $table->string('client_name')->nullable();
            }

            if (!Schema::hasColumn('projects', 'client_type')) {
                $table->string('client_type')->nullable();
            }

            if (!Schema::hasColumn('projects', 'is_from_agent')) {
                $table->boolean('is_from_agent')->default(false)->nullable();
            }

            if (!Schema::hasColumn('projects', 'total_budget')) {
                $table->decimal('total_budget', 15, 2)->nullable();
            }

            if (!Schema::hasColumn('projects', 'chief_area')) {
                $table->string('chief_area')->nullable();
            }

            if (!Schema::hasColumn('projects', 'chief_project')) {
                $table->string('chief_project')->nullable();
            }

            if (!Schema::hasColumn('projects', 'start_at')) {
                $table->dateTime('start_at')->nullable();
            }

            if (!Schema::hasColumn('projects', 'end_at')) {
                $table->dateTime('end_at')->nullable();
            }

            if (!Schema::hasColumn('projects', 'starting_price')) {
                $table->decimal('starting_price', 15, 2);
            }

            if (!Schema::hasColumn('projects', 'discount_percentage')) {
                $table->decimal('discount_percentage', 5, 2)->default(0);
            }

            if (!Schema::hasColumn('projects', 'discounted')) {
                $table->decimal('discounted', 15, 2)->nullable();
            }

            if (!Schema::hasColumn('projects', 'n_firms')) {
                $table->integer('n_firms')->nullable();
            }

            if (!Schema::hasColumn('projects', 'firms_and_percentage')) {
                $table->text('firms_and_percentage')->nullable();
            }

            if (!Schema::hasColumn('projects', 'goals')) {
                $table->text('goals')->nullable();
            }

            if (!Schema::hasColumn('projects', 'project_scope')) {
                $table->text('project_scope')->nullable();
            }

            if (!Schema::hasColumn('projects', 'expected_results')) {
                $table->text('expected_results')->nullable();
            }

            if (!Schema::hasColumn('projects', 'stackholder_id')) {
                $table->json('stackholder_id')->nullable();
            }

            if (!Schema::hasColumn('projects', 'phase_id')) {
                $table->unsignedBigInteger('phase_id')->nullable();
            } 

            // Modify existing columns
            $table->text('note_client')->nullable()->change();
            $table->text('note')->nullable()->change();
            $table->string('logo_path_client')->nullable()->change();
        
    
         /*    if (Schema::hasTable('phases')) {
                $table->foreign('phase_id')->references('id')->on('phases')->onDelete('cascade');
            } */
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Rollback changes
            if (Schema::hasColumn('projects', 'general_info')) {
                $table->dropColumn('general_info');
            }

            if (Schema::hasColumn('projects', 'n_file')) {
                $table->dropColumn('n_file');
            }

            if (Schema::hasColumn('projects', 'name_project')) {
                $table->dropColumn('name_project');
            }

            if (Schema::hasColumn('projects', 'client_name')) {
                $table->dropColumn('client_name');
            }

            if (Schema::hasColumn('projects', 'client_type')) {
                $table->dropColumn('client_type');
            }

            if (Schema::hasColumn('projects', 'is_from_agent')) {
                $table->dropColumn('is_from_agent');
            }

            if (Schema::hasColumn('projects', 'total_budget')) {
                $table->dropColumn('total_budget');
            }

            if (Schema::hasColumn('projects', 'chief_area')) {
                $table->dropColumn('chief_area');
            }

            if (Schema::hasColumn('projects', 'chief_project')) {
                $table->dropColumn('chief_project');
            }

            if (Schema::hasColumn('projects', 'start_at')) {
                $table->dropColumn('start_at');
            }

            if (Schema::hasColumn('projects', 'end_at')) {
                $table->dropColumn('end_at');
            }

            if (Schema::hasColumn('projects', 'starting_price')) {
                $table->dropColumn('starting_price');
            }

            if (Schema::hasColumn('projects', 'discount_percentage')) {
                $table->dropColumn('discount_percentage');
            }

            if (Schema::hasColumn('projects', 'discounted')) {
                $table->dropColumn('discounted');
            }

            if (Schema::hasColumn('projects', 'n_firms')) {
                $table->dropColumn('n_firms');
            }

            if (Schema::hasColumn('projects', 'firms_and_percentage')) {
                $table->dropColumn('firms_and_percentage');
            }

            if (Schema::hasColumn('projects', 'goals')) {
                $table->dropColumn('goals');
            }

            if (Schema::hasColumn('projects', 'project_scope')) {
                $table->dropColumn('project_scope');
            }

            if (Schema::hasColumn('projects', 'expected_results')) {
                $table->dropColumn('expected_results');
            }
            
          
        });
    }
};