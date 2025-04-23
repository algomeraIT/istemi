<?php
namespace Database\Factories;

use App\Models\Attach;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachFactory extends Factory
{
    protected $model = Attach::class;

    public function definition(): array
    {
        $file = $this->faker->randomElement([
            [
                'filename' => 'generic.jpeg',
                'extension' => 'jpeg',
                'size' => 230000,
            ],
            [
                'filename' => 'generic.pdf',
                'extension' => 'pdf',
                'size' => 100000,
            ],
            [
                'filename' => 'generic.xlsx',
                'extension' => 'xlsx',
                'size' => 21800,
            ],
        ]);

        return [
            'user_id' => Users::factory(),
            'path' => 'default/' . $file['filename'],
            'disk_path' => 'public/default/',
            'real_name' => $file['filename'],
            'saved_name' => $this->faker->uuid . '.' . $file['extension'],
            'size' => $file['size'],
            'extension' => $file['extension'],
            'status' => 1,
        ];

        // Default fake file generation
        /*   $extension = $this->faker->fileExtension;
        $uuid = $this->faker->uuid;

        return [
        'user_id' => Users::factory(),
        'path' => 'uploads/' . $uuid . '.' . $extension,
        'disk_path' => 'storage/uploads/',
        'real_name' => $this->faker->word . '.' . $extension,
        'saved_name' => $uuid . '.' . $extension,
        'size' => $this->faker->numberBetween(1000, 5000000), // in bytes
        'extension' => $extension,
        'status' => 1, */
        /*  ]; */
    }
}
