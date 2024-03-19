<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudyRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cnt = rand(1, 4);
        $time = '';
        for ($i = 0; $i < $cnt; $i++) {
            $time .= '1' . ($i + 1) . ':00,';
        }
        $time = substr($time, 0, -1);


        return [
            'campus_id' => rand(1, 2),
            'name' => $this->faker->company . '룸' . ' (' . $this->faker->country . ')',
            'info_desc' => $this->faker->chrome,
            'location' => $this->faker->city,
            'operating_time' => $this->faker->dateTime(),
            'time' => $time,
            'use' => rand(0, 1),
            'max_personnel' => rand(5, 10),
            'min_personnel' => rand(1, 3),
            'office_equipment' => $this->faker->word,
            'room_ip' => rand(11, 255) . '.0.0.1'
        ];
    }
}
