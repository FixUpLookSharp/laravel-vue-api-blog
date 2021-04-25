<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['categories.sport', 'categories.sex', 'categories.games', 'categories.job', 'categories.relax', 'categories.other'];
        $dir = ['sport', 'sex', 'games', 'job', 'relax', 'other'];
        $category = [];

        for ($i = 0; $i < count($categories); $i++) {
            $category[] = [
                'name' => $categories[$i],
                'dir' => $dir[$i],
            ];
        }


        DB::table('article_categories')->insert($category);

    }
}
