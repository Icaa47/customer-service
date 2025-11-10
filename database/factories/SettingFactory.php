<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        $section = $this->faker->randomElement([
            'account',
            'data_management',
            'support',
            'about',
        ]);

        return [
            'section' => $section,
            'section_label' => Str::headline($section),
            'key' => $this->faker->unique()->lexify('setting_????'),
            'label' => $this->faker->sentence(3),
            'type' => Setting::TYPE_TEXT,
            'value' => $this->faker->sentence(2),
            'metadata' => null,
            'description' => $this->faker->optional()->sentence(),
            'sort' => $this->faker->numberBetween(0, 10),
        ];
    }

    public function boolean(): static
    {
        return $this->state(fn () => [
            'type' => Setting::TYPE_BOOLEAN,
            'value' => $this->faker->boolean(),
        ]);
    }

    public function url(): static
    {
        return $this->state(fn () => [
            'type' => Setting::TYPE_URL,
            'value' => $this->faker->url(),
        ]);
    }
}
