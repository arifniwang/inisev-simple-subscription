<?php

namespace Database\Seeders;

use App\Models\PostsModel;
use App\Models\WebsitesModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exist_id = PostsModel::all()->pluck('id')->toArray();
        $websites = WebsitesModel::all();
        $faker = Faker::create('en_EN');
        $id = 0;

        foreach ($websites as $i => $row) {
            for ($j = 1; $j <= 10; $j++) {
                $id += 1;
                if (in_array($id, $exist_id)) continue;

                PostsModel::create([
                    'id' => $id,
                    'websites_id' => $row->id,
                    'title' => 'Post ' . $j . ' - ' . $row->domain,
                    'description' => $faker->text(),
                ]);
            }
        }
    }
}
