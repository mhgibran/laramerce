<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Apple','Avocado','Watermelon','Lemon','Banana','Strawberry','Mango'];
        $price = 5000;
        $margin = 2000;
        $lastPrice = $price;

        for ($i=0; $i < count($names); $i++) {
            $lastPrice = $lastPrice + $margin; 
            DB::table('products')->insert([
                'name' => $names[$i],
                'price' => $lastPrice
            ]);
        }
    }
}
