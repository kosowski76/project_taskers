<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name_project = $this->faker->unique()->numerify('Project_##');
        return[
            'name'        => $name_project,
            'host_url'    => $name_project .'.'. $this->faker->domainName(),
            'description' => $this->faker->sentence(
                $this->faker->numberBetween(5, 12)
            ),
            'customer_id' => $this->faker->numberBetween(1, 4
            ),
            'status'      => $this->faker->randomElement(
                Project::getAvailablesStatuses()
            )
        ];
    }
}