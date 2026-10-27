<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('currencies')->insert([
            [
                'name' => 'Peso Argentino',
                'symbol' => 'ARS',
                'exchange_rate' => 1.000000,
            ],
            [
                'name' => 'Dolar',
                'symbol' => 'USD',
                'exchange_rate' => 1450.000000,
            ],
            [
                'name' => 'Euro',
                'symbol' => 'EUR',
                'exchange_rate' => 1680.000000,
            ],
        ]);
    }
}
