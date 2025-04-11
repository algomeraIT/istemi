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
        return [
            'user_id' => Users::factory(),
            'path' => 'uploads/' . $this->faker->uuid . '.' . $this->faker->fileExtension,
            'disk_path' => 'storage/uploads/',
            'real_name' => $this->faker->word . '.' . $this->faker->fileExtension,
            'saved_name' => $this->faker->uuid . '.' . $this->faker->fileExtension,
            'size' => $this->faker->numberBetween(1000, 5000000), //bytes
            'extension' => $this->faker->fileExtension,
            'status' => 1,
        ];
    }
}
