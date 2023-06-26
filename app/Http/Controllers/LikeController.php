<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

use Inertia\Inertia;

class LikeController extends Controller
{

    public function like($id)
    {
        // auth()->user()->likes()->create(['post_id' => $id, 'text' => 'liked']);
        
        $user_id = auth()->user()->id;
        $check_like = Like::where(['user_id' => $user_id, 'post_id' => $id])->first();
        // dd("like me", $check_like);
        $like_status = false;
        if (!empty($check_like)) {
            $check_like->delete();
        }
        else {
            $new_like = Like::create([
                'user_id' => $user_id,
                'post_id' => $id,
                'text' => 'liked'
            ]);

            $new_like->save();
            $like_status = true;
        }

        $user = auth()->user();
        // $posts = Post::orderBy('created_at', 'desc')->with('pet.user', 'comments.user','likes.user')->get();
        // dd($posts);
        // $post = Post::where('id', $id)->with('pet.user', 'comments.user','likes')->first();
        // return Inertia::render('Post', [
        //     'post' => $post,
        //     // 'user' => $user
        // ]);


        // return response()->json(['post' => $post, 'message' => 'Post liked']);
        // return response()->json(['post' => $post, 'message' => 'Post liked', 'like' => $like_status]);
    }

    public function unlike(Post $post)
    {
        // auth()->user()->likes()->where('post_id', $post->id)->delete();
        return response()->json(['message' => 'Post unliked']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(like $like)
    {
        //
    }
}
