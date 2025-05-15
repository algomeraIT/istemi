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
        // 1) Costruisci il path al file, NON File::get
        $path = database_path('seeders/data/product_odoo_active.json');

        // 2) Verifica che esista davvero
        if (! File::exists($path)) {
            dd("File non trovato: {$path}");
        }

        // 3) Leggi il contenuto del file
        $json = File::get($path);

        // 4) Se è NDJSON, puliscilo o parsalo riga per riga,
        //    altrimenti se è un array JSON skip questo step.

        // 5) Decode in array
        $records = json_decode($json, true);
        if (is_null($records)) {
            dd('json_decode error: '.json_last_error_msg());
        }

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
            $isActive    = $odoo['is_active'];

            // 5. Genera unique code
            $uniqueCode = $odoo['default_code'];

            $uniqueCode = $uniqueCode ?? generateUniqueCode(
                \App\Models\Product::class,
                'unique_code',
                $categoryName,
                $title
            );;

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
