<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class HomeComponent extends Component
{
    public function render()
    {
        $slider = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',', $category->sel_categories);
        $categories = Category::whereIn('id', $cats)->get();
        $no_of_products = $category->no_of_products;
        $c_products = DB::table('products')->get();
        $sproducts = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);

        // return view('livewire.home-component', ['categoriess' => $categoriess])->layout('layouts.base');
        return view('livewire.home-component', compact('categories', 'slider', 'lproducts', 'c_products', 'no_of_products', 'sproducts', 'sale'))->layout('layouts.base');
    }
}
