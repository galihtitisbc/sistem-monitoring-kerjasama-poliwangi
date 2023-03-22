<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(1)->create();
        // \App\Models\User::factory()->create([
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('admin')
        // ]);
        $this->call(KategoriSeeder::class);
        $this->call(ProdiSeeder::class);
    }
}
