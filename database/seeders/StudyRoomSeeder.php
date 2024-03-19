<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudyRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\StudyRoom::factory()->times(50)->create();
    }
}
