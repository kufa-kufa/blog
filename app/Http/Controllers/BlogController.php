<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::when($request->search, function($query) use($request) {
                        $search = $request->search;
                        
                        return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
                    })->with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->published()
                    ->simplePaginate(5);

        return view('frontend.index', compact('posts'));
    }

    public function post(Post $post)
    {
        $post = $post->load(['comments.user', 'tags', 'user', 'category']);
        $recent_posts=Post::where('is_published', true)->whereNotIn('id',[$post->id])->get();
        $categories = Category::with('posts')->get();
        $tags = Tag::all();

        return view('frontend.post', compact('post','categories','tags','recent_posts'));
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['comment' => 'required']);

        $post->comments()->create([
            'body' => $request->comment
        ]);
        flash()->overlay(__('form.Comment_created_successfully'));

        return redirect("/posts/{$post->id}");
    }
}
