<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Tasks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($index = 0; $index < 4; $index++) {
            DB::table('tasks')->insert([
                'task' => Str::random(10),
                'description' => Str::random(20),
                'status' => 1,
                'priority' => rand(1, 3),
                'dead_line' => new Carbon('tomorrow'),
                'closing_date' => Carbon::now(),
                'user_id' => rand(1, 5),
                'categorie_task_id' => rand(1, 2),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]);
        }
    }
}
