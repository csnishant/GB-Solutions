<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run() {
        $categories = ['Fruits', 'Vegetables', 'Dairy', 'Bakery'];
        foreach($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
