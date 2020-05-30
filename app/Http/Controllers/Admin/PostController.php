<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
//use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use File;
use Lang;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags', 'comments'])->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
        'title'       => $request->title,
        'body'        => $request->body,
        'category_id' => $request->category_id,
    ]);
        // Store Post Image
        $this->uploadPostImage($request, $post, "create");
        $tagsId = collect($request->tags)->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post->tags()->attach($tagsId);
        flash()->overlay(__('form.Post_created_successfully'));

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = $post->load(['user', 'category', 'tags', 'comments']);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay(__('form.You_cant_delete_other_peoples_post'));
            return redirect('/admin/posts');
        }

        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // disbust cache
        Cache::forget($post->etag);

        $post->update([
            'title'       => $request->title,
            'body'        => $request->body,
            'category_id' => $request->category_id
        ]);
        // Store Post Image
        $this->uploadPostImage($request, $post, "update");
        $tagsId = collect($request->tags)->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post->tags()->sync($tagsId);
        flash()->overlay(__('form.Post_updated_successfully'));

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay(__('form.You_cant_delete_other_peoples_post'));
            return redirect('/admin/posts');
        }

        $post->delete();
        flash()->overlay(__('form.Post_deleted_successfully'));

        return redirect('/admin/posts');
    }

    public function publish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();
        flash()->overlay(__('form.Post_changed_successfully'));

        return redirect('/admin/posts');
    }

    public function uploadPostImage(Request $request, $post, $type)
    {
        // store image if exist
        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' .$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(1024,768)->save($location);
            // If update we need delete old image file from folder
            if($type == "update") {
                $old_image_path = public_path("images/{$post->image}");
                if (File::exists($old_image_path)) {
                    File::delete($old_image_path);
                }
            }
            $post->update(['image'=>$filename]);
        }
    }

}
