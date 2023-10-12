<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password'),
            'roles' => 'OWNER'
        ]);
    }
}
