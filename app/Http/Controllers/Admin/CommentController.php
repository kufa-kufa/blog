<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_admin == true) {
            $comments = Comment::with('post')->paginate(10);
        }
        else {
            $comments = Comment::with('post')->where('user_id','=',auth()->user()->id)->paginate(10);
        }


        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::where('is_published',true)->pluck('title', 'id');
        return view('admin.comments.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['body' => 'required']);

        Comment::create(
            [
                'body' => $request->body,
                'post_id' => $request->post_id,
                'user_id' => auth()->user()->id,
            ]
        );
        flash()->overlay(__('form.Comment_created_successfully'));

        return redirect('/admin/comments');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay(__('form.You_cant_delete_other_peoples_comment'));
            return redirect('/admin/posts');
        }

        $comment->delete();
        flash()->overlay(__('form.Comment_deleted_successfully'));

        return redirect('/admin/comments');
    }
}
