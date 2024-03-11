<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('transactions')->insert([
            'amount' => 10.5,
            'description' => 'Migration transaction as deposit',
            'type' => 'DEPOSIT',
            'status' => 'APPROVED',
            'user_id' => 1,
        ]);

        DB::table('transactions')->insert([
            'amount' => 500,
            'description' => 'Migration transaction as purchase',
            'type' => 'PURCHASE',
            'status' => 'REJECTED',
            'user_id' => 1,
        ]);
    }
}
