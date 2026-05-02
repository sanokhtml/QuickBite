<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = \App\Models\Restaurant::with(['category', 'media'])->latest()->get();

        return view('post.index', [
            'restaurants' => $restaurants
        ]);
    }

    public function category(Category $category)
    {

        $restaurants = $category->restaurants()
            ->with(['category', 'media'])
            ->latest()
            ->get();

        return view('post.index', [
            'restaurants' => $restaurants,
            'currentCategory' => $category
        ]);
    }


    public function create()
    {
        return redirect()->route('restaurant.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        // $image = $data['image'];
        // unset( $data['image']);
        $data['user_id'] = Auth::id();

        // $imagePath = $image->store('posts', 'public');
        // $data['image'] = $imagePath;

        $post = Post::create($data);

        $post->addMediaFromRequest('image')
            ->toMediaCollection();

        return redirect()->route('dashboard')->with('success','');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::get();
        return view('post.edit', [
            'post' => $post,
            'categories'=> $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validated();
        $post->update($data);

        if ($data['image'] ?? false) {
            $post->addMediaFromRequest('image')
                ->toMediaCollection();
        }

        return redirect()->route('myPosts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
            $post->delete();

        return redirect()->route('dashboard');
    }

    public function myPosts()
    {
        $user = Auth::user();
        $posts = $user->posts()
            ->with(['user','media'])
            ->withCount('claps')
            ->latest()->simplePaginate(5);
            
        return view('post.index', [
            'posts'=> $posts,
            ]);
    }
}
