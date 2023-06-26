<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AllPostsCollection;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Image;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:2048',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');

        return $videoPath;
    }
    public function index()
    {
        $user = auth()->user();
        $posts = Post::orderBy('created_at', 'desc')->with('pet.user', 'comments.user','likes.user')->get();
        // dd($posts);
        return Inertia::render('Posts', [
            'posts' => $posts,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request, $id)
    {
        $request->validate([
            'text' => 'required',
            // 'image' => 'nullable|mimes:jpg,jpeg,png,gif|required_without:video',
            // 'video' => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:2048',
        ]);
        
        // dd($request);
        
        

        $image_path = '';
        $video_path = '';

        $post = new Post();
        $post->pet_id = $id;
        $post->text = $request->input('text');
        if ($request->image != "null") {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            switch($extension) {
                case 'jpg':
                case 'png':
                case 'gif':
                case 'jpeg':
                case 'gif':
                case 'tiff':
                    $image_path = $this->imageSave($request);
                    $post->image = $image_path;
                    break;
                case 'mp4':
                case 'webm':
                case 'ogg':
                    $video_path = $this->videoSave($request->file('image'));
                    $post->video = $video_path;
                    break;
                default: 
                    return "invalid file type";
            }
        }

        // if ($request->video != 'null') {
        //     $video_path = $this->videoSave($request);
        // }
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
        if (!empty($post->video)) {
            if (file_exists(public_path($post->video))){
                unlink(public_path($post->video));
            }
            // else {
            //     dd('File does not exists.');
            // }
        }
        $post->delete();

    }

    public function imageSave($request)
    {

        $image = Image::make($request->file('image'));



        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();


        $name = time() . '.' . $extension;
        $image->save(public_path() . '/images/' . $name);
        // dd($model);
        $image_path = '/images/' . $name;

        return $image_path;
    }

    public function videoSave($file)
    {
        // $file = $request->file('video');
        // dd('file', public_path('videos'));
        $extension = $file->getClientOriginalExtension();
        $name = time() . '.' . $extension;
        $file->move(public_path('videos'), $name);

        $video_path = '/videos/' . $name;

        return $video_path;
    }
}
