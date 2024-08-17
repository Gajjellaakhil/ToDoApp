<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Todo;
use Faker\Factory as Faker;

class GroupsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $group = Group::create([
                'name' => $faker->word,
            ]);

            for ($j = 0; $j < 10; $j++) {
                Todo::create([
                    'title' => $faker->sentence,
                    'is_complete' => $faker->boolean,
                    'group_id' => $group->id,
                ]);
            }
        }
    }
}

