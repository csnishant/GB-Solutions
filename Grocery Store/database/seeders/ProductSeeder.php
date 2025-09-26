<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run() {
        $products = [
            ['name'=>'Apple', 'price'=>50, 'category_id'=>1],
            ['name'=>'Banana', 'price'=>20, 'category_id'=>1],
            ['name'=>'Milk', 'price'=>40, 'category_id'=>3],
            ['name'=>'Bread', 'price'=>30, 'category_id'=>4],
        ];
        foreach($products as $p) {
            Product::create($p);
        }
    }
}
