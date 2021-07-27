<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $occupationsCount = rand(2, 4);
        $occupations = [];
        for($i = 1; $i <= $occupationsCount; $i++){
            array_push($occupations,$this->faker->jobTitle );
        }
        return [
            'name' => $this->faker->unique()->name($gender),
            'birthday' => $this->faker->date('Y-m-d'),
            'occupations' => $occupations,
            'img' => 'https://placeimg.com/100/100/any?' . rand(1, 100),
            'nickname' => $this->faker->firstName,
            'portrayed' => $this->faker->unique()->name($gender)
        ];
    }
}
