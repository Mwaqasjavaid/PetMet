<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllPostsCollection;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        // dd($posts);
        return Inertia::render('Posts', [
            'posts' => new AllPostsCollection($posts)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([ 'text' => 'required' ]);
    //     $post = new Post;

    //     if ($request->hasFile('image')) {
    //         $request->validate([ 'image' => 'required|mimes:jpg,jpeg,png' ]);
    //         $post = (new ImageService)->updateImage($post, $request);
    //     }

    //     $post->user_id = auth()->user()->id;
    //     $post->text = $request->input('text');
    //     $post->save();
    // }
    public function store(Request $request, $id)
    {
        $request->validate([
            // 'pet_id' => 'required',
            'text' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $image_path='';
        if($request->image) {
            $image_path = $this->imageSave($request);
        }
        
        $post = new Post();
        $post->pet_id = $id;
        $post->text = $request->input('text');
        $post->image = $image_path;
        // Handle image upload and save
        
        $post->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if (!empty($post->image)) {
            $currentImage = public_path() . $post->image;

            if (file_exists($currentImage)) {
                unlink($currentImage);
            }
        }
        $post->delete();
    }

    public function imageSave($request)
    {

        $image = Image::make($request->file('image'));

        // if (!empty($image)) {
        //     $currentImage = public_path() . $image;

        //     if (file_exists($currentImage) && $currentImage != public_path() . '/images/user-placeholder.png') {
        //         unlink($currentImage);
        //     }
        // }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        // if ($request->width) {
        //     $image->crop(
        //         $request->width,
        //         $request->height,
        //         $request->left,
        //         $request->top
        //     );
        // }

        $name = time() . '.' . $extension;
        $image->save(public_path() . '/images/' . $name);
        // dd($model);
        $image_path = '/images/' .$name;

        return $image_path;
    }
}
