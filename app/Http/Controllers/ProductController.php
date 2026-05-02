<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Restaurant;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.product-create', compact('restaurants'));
    }


public function store(StoreProductRequest $request)
{
    $product = Product::create($request->validated());

    if ($request->hasFile('image')) {
        $product->addMediaFromRequest('image')->toMediaCollection('images');
    }

    // Варіант А: Перевантажити зв'язок перед використанням
    $product->load('restaurant'); 

    return redirect()->route('restaurant.show', $product->restaurant->slug);
}
}