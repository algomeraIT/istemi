<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Enums\ParentProductCategoryEnum;
use App\Enums\MeasurementUnitEnum;
use Illuminate\Support\Str;
use function generateUniqueCode;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Carica il JSON da database/seeders/data/query_odoo.json
        $json = File::get(database_path('seeders/data/product_odoo_active.json'));
        $records = json_decode($json, true);

        foreach ($records as $odoo) {
            // 2. Prendi il nome categoria e unità di misura
            $categoryName = $odoo['category_name'] ?? 'Altro';
            $uomName      = $odoo['uom_name']      ?? 'Unità';

            // 3. Mappa stringhe Odoo sugli enum (tryFrom restituisce null se non trova)
            $categoryEnum = ParentProductCategoryEnum::tryFrom($categoryName)
                ?? ParentProductCategoryEnum::ALTRO;

            $udmEnum = MeasurementUnitEnum::tryFrom($uomName)
                ?? MeasurementUnitEnum::UNITA;

            // 4. Prepara gli altri campi
            $title       = trim($odoo['title'] ?? $odoo['name'] ?? '');
            $description = trim($odoo['description'] ?? $odoo['description_sale'] ?? '');
            $price       = $odoo['price'] ?? 0.00;
            $isActive    = (bool) ($odoo['is_active'] ?? true);

            // 5. Genera unique code
            $uniqueCode = generateUniqueCode(
                \App\Models\Product::class,
                'unique_code',
                $categoryName,
                $title
            );

            // 6. Inserisci nel database
            DB::table('products')->insert([
                'category'    => $categoryEnum->value,
                'unique_code' => $uniqueCode,
                'title'       => $title,
                'udm'         => $udmEnum->value,
                'description' => $description ?: null,
                'price'       => $price,
                'is_active'   => $isActive,
                'is_cnpaia'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
