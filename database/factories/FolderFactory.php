<?php

namespace Database\Factories;

use App\Models\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Folder>
 */
class FolderFactory extends Factory
{
    protected const array SEPARATORS = [' ', '-', '_', '.'];

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::of($this->faker->sentence(2))
                ->slug(self::SEPARATORS[array_rand(self::SEPARATORS)])
                ->title(),
        ];
    }
}
