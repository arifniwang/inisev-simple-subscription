<?php

namespace Database\Seeders;

use App\Models\SubscriberModel;
use App\Models\WebsitesModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exist_id = SubscriberModel::all()->pluck('id')->toArray();
        $websites = WebsitesModel::all()->pluck('id')->toArray();
        $faker = Faker::create('en_EN');
        $id = 0;

        foreach ($websites as $i => $web_id) {
            for ($j = 0; $j < 10; $j++) {
                $id += 1;
                if (in_array($id, $exist_id)) continue;

                SubscriberModel::create([
                    'id' => $id,
                    'websites_id' => $web_id,
                    'email' => $faker->email
                ]);
            }
        }
    }
}
