<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTasks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($index = 0; $index < 2; $index++) {
            DB::table('categories_tasks')->insert([
                'category' => Str::random(10),
                'description' => Str::random(20),
                'status' => 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]);
        }
    }
}
