<?php

namespace Database\Factories;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Task;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'title' => $this->faker->sentence(
                $this->faker->numberBetween(3, 8)
            ),
            'content' => $this->faker->sentence(
                $this->faker->numberBetween(8, 16)
            ),
            'status' => $this->faker->randomElement(
                Task::getAvailablesStatuses()
            )
        ];
    }
}

/*
$factory->define(Task::class, function(Faker $faker)
{
    return[
        'title' => $faker->sentence(
            $faker->numberBetween(3, 8)
        ),
        'content' => $faker->sentence(
            $faker->numberBetween(8, 16)
        ),
        'status' => $faker->randomElement(
            Task::getAvailablesStatuses()
        )
    ];
});
*/