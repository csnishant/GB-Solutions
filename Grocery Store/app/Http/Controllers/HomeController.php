<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get(); // products ke saath category bhi load hoga
        return view('customer.home', compact('categories', 'products'));
    }
}
