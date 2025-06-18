<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id() ?? 1, // Для демонстрації використовуємо ID 1
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image_path'] = $imagePath;
        }

        $post = Post::create($data);

        // Відправляємо нотифікації всім користувачам, які дозволили їх
        $users = User::where('notification_allowed', true)->get();
        
        foreach ($users as $user) {
            $user->notify(new NewPostNotification($post));
        }

        return redirect()->route('posts.index')
            ->with('success', 'Пост успішно створено та нотифікації відправлено!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            // Видаляємо старе зображення
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image_path'] = $imagePath;
        }

        $post->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Пост успішно оновлено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Пост успішно видалено!');
    }
}
