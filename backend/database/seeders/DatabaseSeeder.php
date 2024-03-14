<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();



        \App\Models\User::factory()->create([
            'username' => '1',
            'password' => Hash::make('1'),
            'type' => 'DEFAULT'
        ]);

        \App\Models\User::factory()->create([
            'username' => '2',
            'password' => Hash::make('2'),
            'type' => 'DEFAULT'
        ]);

        \App\Models\User::factory()->create([
            'username' => '3',
            'password' => Hash::make('3'),
            'type' => 'DEFAULT'
        ]);

        \App\Models\User::factory()->create([
            'username' => 'admin',
            'password' => Hash::make('123'),
            'type' => 'ADMIN'
        ]);

        DB::table('transactions')->insert([
            'amount' => 10.5,
            'description' => 'FIRST TRANSACTION',
            'type' => 'DEPOSIT',
            'status' => 'APPROVED',
            'user_id' => 1,
        ]);

        DB::table('transactions')->insert([
            'amount' => 500.54,
            'description' => 'SECOND TRANSACTION',
            'type' => 'PURCHASE',
            'status' => 'REJECTED',
            'user_id' => 1,
        ]);

        DB::table('transactions')->insert([
            'amount' => 142.76,
            'description' => 'THIS APPEAR ONLY FOR 2',
            'type' => 'DEPOSIT',
            'status' => 'PENDING',
            'user_id' => 2,
        ]);

        DB::table('transactions')->insert([
            'amount' => 9.5,
            'description' => 'only for 3',
            'type' => 'DEPOSIT',
            'status' => 'APPROVED',
            'user_id' => 3,
        ]);

        DB::table('transactions')->insert([
            'amount' => 56.00,
            'description' => 'user_id3 3',
            'type' => 'DEPOSIT',
            'status' => 'PENDING',
            'user_id' => 3,
        ]);

        DB::table('transactions')->insert([
            'amount' => 142.76,
            'description' => 'user_id3',
            'type' => 'DEPOSIT',
            'status' => 'REJECTED',
            'user_id' => 3,
        ]);
    }
}
