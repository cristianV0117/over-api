<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($index = 0; $index < 11; $index++) {
            DB::table('users')->insert([
                'user_name' => 'default' . $index,
                'first_name'=> 'default',
                'second_name'=> 'default',
                'first_last_name'=> 'default',
                'second_last_name'=> 'default',
                'email'=> Str::random(10) . '@default.com',
                'cellphone'=> '1234567890',
                'password' => password_hash('default', PASSWORD_DEFAULT),
                'state_id'=> rand(1, 4),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]);
        }
    }
}
