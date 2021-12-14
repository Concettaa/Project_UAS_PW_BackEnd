<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jonathan Kevin Susanto',
            'email' => '10070@students.uajy.ac.id',
            'password' => '$2b$10$mjc/zZqJUNO4nN4LMwBto.WESsqbgycud/f4aJ.pnXnjTxFTOudZy',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
