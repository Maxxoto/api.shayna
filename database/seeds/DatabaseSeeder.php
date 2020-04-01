<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'ahmatdanis24@gmail.com',
            'name' => 'dani',
            'password' => bcrypt('12345678'),

        ]);

        DB::table('products')->insert([
            'name' => 'Unikelo',
            'slug' => 'unikelo',
            'type' => 'Shirt',
            'description' => 'Baju terbaru super murah',
            'price' => '10000',
            'quantity' => '10'
        ]);

        DB::table('transactions')->insert([
            'user_id' => '1',
            'name' => 'TRX001',
            'email' => 'zuhad14223@gmail.com',
            'number' => '085031239492',
            'address' => 'Jl.karangan 4/28 Surabaya',
            'transaction_total' => '100000',
            'transaction_status' => 'PENDING'
        ]);
        DB::table('transactions')->insert([
            'user_id' => '1',
            'name' => 'TRX002',
            'email' => 'zuha1d11@gmail.com',
            'number' => '085031239492',
            'address' => 'Jl.karangan 4/28 Surabaya',
            'transaction_total' => '100000',
            'transaction_status' => 'FAILED'
        ]);
        DB::table('transaction_details')->insert([
            'transactions_id' => '1' ,
            'products_id' => '1'
        ]);
    }
}
