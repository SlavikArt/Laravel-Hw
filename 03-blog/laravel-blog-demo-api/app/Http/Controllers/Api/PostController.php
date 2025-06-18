<?php

namespace App\Http\Controllers\Api;

use App\Events\PostPublished;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Post::with('tags', 'author')
            ->withCount('comments', 'likes', 'tags');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->has('published')) {
            $published = $request->get('published');
            $query->where('is_publish', $published);
        }

        if ($request->has('author')) {
            $author = $request->get('author');
            $query->where('user_id', $author);
        }

        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $direction = 'asc';
            
            if (str_starts_with($sort, '-')) {
                $direction = 'desc';
                $sort = substr($sort, 1);
            }
            
            if (in_array($sort, ['title', 'created_at'])) {
                $query->orderBy($sort, $direction);
            }
        } else {
            $query->latest();
        }

        $posts = $query->paginate(10);
        
        return response()->json(PostResource::collection($posts));
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::create($request->except('tags'));

        if ($request->has('tags')) {
            $post->tags()->attach($request->input('tags'));
        }

        $users = User::query()->limit(2)->get();
        foreach ($users as $user) {
            $user->notify(new NewPostNotification($post));
        }

        $post->load('tags', 'author')->loadCount(['comments', 'likes', 'tags']);
        return response()->json(new PostResource($post), 201);
    }

    public function show(Post $post): JsonResponse
    {
        $post->load('tags', 'author')->loadCount(['comments', 'likes', 'tags']);
        return response()->json(new PostResource($post), 200);
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->except('tags'));

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        $post->load('tags', 'author')->loadCount(['comments', 'likes', 'tags']);
        return response()->json(new PostResource($post), 200);
    }

    public function publish(Request $request, Post $post): JsonResponse
    {
        $post->update([
            'is_publish' => true
        ]);

        event(new PostPublished($post, "insider.smidt@gmail.com"));

        return response()->json(new PostResource($post->load('tags')), 200);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->tags()->detach();
        $post->delete();

        return response()->json(null, 204);
    }
}
