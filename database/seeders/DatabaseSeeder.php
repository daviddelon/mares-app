<?php

namespace Database\Seeders;

use App\Models\Mare;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'David Delon',
            'email' => 'david.delon@clapas.net',
            'password' => 'password'
        ]);


        //$mares=Mare::factory(3)->create();
        //Tag::factory(3)->hasAttached($mares)->create();
        $this->call(MaresTableSeeder::class);
    }
}
