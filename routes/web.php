<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ProductController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');
});

Route::get('/restaurant/{restaurant:slug}', [RestaurantController::class, 'show'])
    ->name('restaurant.show');

Route::get('/@{user:username}', [PublicProfileController::class, 'show'])
    ->name('profile.show');

    Route::get('/@{username}', [PostController::class, 'show'])
    ->name('profile.show');
        
    Route::get('/', [PostController::class, 'index'])
    ->name('dashboard');

    Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])
    ->name('post.show');

    Route::get('/c/{category}', [PostController::class,'category'])
    ->name('post.byCategory');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/post/create', [PostController::class, 'create'])
    ->name('post.create');

    Route::post('/post/create', [PostController::class, 'store'])
    ->name('post.store');

    Route::get('/post/{post:slug}', [PostController::class, 'edit'])
    ->name('post.edit');

    Route::put('/post/{post}', [PostController::class, 'update'])
    ->name('post.update');

    Route::delete('/post/{post}', [PostController::class, 'destroy'])
    ->name('post.destroy');

    Route::get('/my-posts', [PostController::class, 'myPosts'])
    ->name('myPosts');

    Route::post('/follow/{user:id}', [FollowerController::class, 'followUnfollow'])
    ->name('follow');

    Route::post('/clap/{post}', [ClapController::class, 'clap'])
    ->name('calp');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
