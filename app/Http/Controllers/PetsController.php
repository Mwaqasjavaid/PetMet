<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Image;

use App\Services\ImageService;
class PetsController extends Controller
{

    public function index()
    {
        // $pets = Pet::orderBy('created_at', 'desc')->get();
        $pets = Pet::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Pets', [
            'pets' => $pets
            ]);
    }
    public function changepet()
    {
        return redirect('/');
    }
    
    public function show($id)
    {
        // $pets = Pet::orderBy('created_at', 'desc')->get();
        $pet = Pet::where('id', $id)->first();
        $posts = Post::where('pet_id', $pet->id)->with('pet', 'comments.user')->get();
        return Inertia::render('PetProfile', [
            'pet' => $pet,
            'posts' => $posts
            ]);
    }

    public function store(Request $request)
    {
        // dd("testing". $request);
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'age' => 'required',
        ]);

        // Create a new AddPets instance with the validated data
        $addPets = new Pet;
        $addPets->user_id = auth()->user()->id;
        $addPets->name = $validatedData['name'];
        $addPets->category = $validatedData['category'];
        $addPets->age = $validatedData['age'];

        // Save the AddPets instance to the database
        $addPets->save();

        // Optionally, you can return a response indicating the success of the operation
        // return response(['status' => 'success','message' => 'AddPets saved successfully']);
        // return Inertia::render('AddPets', [
        //     // 'status' => 'sucess',
        //     'message' => 'UserPet saved successfully'
        // ]);

        return redirect()->route('pets.index')->with('message', 'UserPet saved successfully');
    
        // return redirect()->back()->with('message', 'UserPet saved successfully');
    
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([ 'image' => 'required|mimes:jpg,jpeg,png' ]);
        
        $pet_updated = $this->imageSave($id, $request);
        $pet_updated->save();
    }

    public function imageSave($id, $request)
    {
        // dd($id);
        $model = Pet::where('id', $id)->first();
        $image = Image::make($request->file('image'));

        if (!empty($model->image)) {
            $currentImage = public_path() . $model->image;

            if (file_exists($currentImage) && $currentImage != public_path() . '/images/user-placeholder.png') {
                unlink($currentImage);
            }
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        if ($request->width) {
            $image->crop(
                $request->width,
                $request->height,
                $request->left,
                $request->top
            );
        }

        $name = time() . '.' . $extension;
        $image->save(public_path() . '/images/' . $name);
        // dd($model);
        $model->image = '/images/' .$name;

        return $model;
    }
}

