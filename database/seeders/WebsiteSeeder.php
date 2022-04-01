<?php

namespace Database\Seeders;

use App\Models\WebsitesModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exist_id = WebsitesModel::all()->pluck('id')->toArray();
        $faker = Faker::create('en_EN');

        for ($id = 1; $id <= 10; $id++) {
            if (in_array($id, $exist_id)) continue;

            WebsitesModel::create([
                'id' => $id,
                'domain' => $faker->domainName
            ]);
        }
    }
}
