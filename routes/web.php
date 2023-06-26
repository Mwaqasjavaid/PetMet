<?php
use App\Http\Controllers\PetsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/addpets', function () {
    return Inertia::render('AddPets');
})->name('addpets')->middleware('auth');

Route::get('/petprofile', function () {
    return Inertia::render('PetProfile');
})->name('petprofile')->middleware('auth');
Route::put('/posts/{id}/like', [LikeController::class, 'like'])->middleware('auth')->name('posts.like');

Route::put('/posts/{post}/unlike', [LikeController::class, 'unlike'])->middleware('auth')->name('posts.unlike');


// Route::get('/', [PetsController::class, 'index'])->name('pets.index');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::post('/pets', [PetsController::class, 'store'])->name('pets.store');
    Route::get('/pet/{id}', [PetsController::class, 'show'])->name('pets.show');
    Route::get('/', [PetsController::class, 'index'])->name('pets.index');  
    Route::get('/changepet', [PetsController::class, 'changepet']);
    Route::post('/pet/{id}/update-image', [PetsController::class, 'updateImage'])->name('pet.updateImage');

    Route::get('/pets/search', [PetsController::class, 'search'])->name('pets.search');
    
//    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::post('/post/{id}', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('/user/update-image', [UserController::class, 'updateImage'])->name('user.updateImage');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //vedio routes
    Route::post('/post/{id}/video', [PostController::class, 'storeVideo'])->name('post.storeVideo');
    Route::delete('/post/{id}/video', [PostController::class, 'destroyVideo'])->name('post.destroyVideo');
    

});

require __DIR__.'/auth.php';

