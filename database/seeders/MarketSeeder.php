<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $markets = [
            [
                'title' => 'Binance',
                'name' => 'صرافی بایننس',
                'description' => 'Binance is an online exchange where users can trade cryptocurrencies.',
            ],
            [
                'title' => 'CoinEx',
                'name' => 'صرافی کوینکس',
                'description' => 'CoinEx is an online exchange where users can trade cryptocurrencies.',
            ]
        ];
        foreach ($markets as $item) {
            Market::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
