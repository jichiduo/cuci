<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'unit' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'price' => $this->faker->randomFloat(2, 0, 999999999999999999.99),
            'turnover' => $this->faker->randomFloat(2, 0, 999999.99),
            'express_price' => $this->faker->randomFloat(2, 0, 999999999999999999.99),
            'express_turnover' => $this->faker->randomFloat(2, 0, 999999.99),
            'acc_code' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'acc_name' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'status' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'remark' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'equipment' => $this->faker->boolean(),
            'brand' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'model' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'warranty_period' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'warranty_start_date' => $this->faker->dateTime(),
            'warranty_end_date' => $this->faker->dateTime(),
            'useful_life' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'life_end_date' => $this->faker->dateTime(),
            'location' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'group_id' => $this->faker->randomNumber(),
        ];
    }
}
