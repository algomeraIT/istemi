<?php

use App\Models\Client;
use App\Models\Issuer;
use App\Models\PriceList;
use App\Models\QuoteTemplate;
use App\Models\TaxRate;
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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();                       // es. PRV20250064
            $table->foreignIdFor(Issuer::class)->nullable()->constrained();
            $table->foreignIdFor(Client::class)->nullable()->constrained();
            $table->enum('status', ['draft','sent','accepted','rejected','expired'])
                ->default('draft');
            $table->date('due_date');                   // scadenza
            $table->decimal('total', 12, 2)->default(0);             // totale
            $table->string('billing_country');
            $table->string('billing_city');
            $table->string('billing_province');
            $table->string('billing_address');
            $table->string('delivery_country');
            $table->string('delivery_city');
            $table->string('delivery_province');
            $table->string('delivery_address');
            $table->string('subject');                  // oggetto
            $table->foreignIdFor(PriceList::class)->nullable()->nullable()->constrained();
            $table->foreignIdFor(QuoteTemplate::class)->nullable()->nullable()->constrained();
            $table->json('terms')->nullable();
            $table->foreignIdFor(TaxRate::class)->nullable()->nullable()->constrained();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
