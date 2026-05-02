<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('products');

        return view('restaurants.show', [
            'restaurant' => $restaurant
        ]);
    }
    public function create()
{
    $categories = Category::all();
    return view('restaurants.create', compact('categories'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'delivery_time' => 'nullable|string',
        'delivery_price' => 'nullable|numeric',
        'cover' => 'required|image|max:2048',
    ]);

    $restaurant = Restaurant::create([
        'name' => $validated['name'],
        'slug' => \Illuminate\Support\Str::slug($validated['name']),
        'description' => $validated['description'],
        'category_id' => $validated['category_id'],
        'delivery_time' => $validated['delivery_time'],
        'delivery_price' => $validated['delivery_price'],
    ]);

    if ($request->hasFile('cover')) {
        $restaurant->addMediaFromRequest('cover')->toMediaCollection('covers');
    }

    return redirect()->route('restaurant.show', $restaurant->slug)
                     ->with('success', 'Заклад успішно зареєстровано!');
}
}