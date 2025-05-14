<?php

use App\Enums\MeasurementUnitEnum;
use App\Enums\ParentProductCategoryEnum;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ParentProductCategoryEnum::valuesArray());
            $table->string('unique_code');
            $table->text('title');
            $table->enum('udm', MeasurementUnitEnum::valuesArray())->comment('unità di misura');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_cnpaia')->default(true)->comment('Cassa Nazionale di Previdenza e Assistenza per gli Ingegneri e Architetti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
