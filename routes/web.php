<?php

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    /*
    $images = Image::all();
    foreach($images as $image){
        echo $image->image_path."<br>";
        echo $image->description."<br>";
        echo $image->user->name.' '.$image->user->surname."<br>";

        if (count($image->comments) >= 1) {
            echo '<h3>Comentarios</h3>';
            foreach($image->comments as $comment){
                echo $comment->user->name.' '.$comment->user->surname.': ';
                echo $comment->content.'<br>';
            }
        }
        echo 'LIKES: '.count($image->likes);
        echo '<hr><hr>';
        
    }
    */
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Usuario
Route::get('/configuracion', [UserController::class, 'config'])->name('config');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
Route::get('/gente/{search?}', [UserController::class, 'index'])->name('user.index');
Route::get('/perfil/{id}', [UserController::class, 'profile'])->name('profile');

//Imagen
Route::get('/subir-imagen', [ImageController::class, 'create'])->name('image.create');
Route::post('/imagen/save', [ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/imagen/{id}', [ImageController::class, 'detail'])->name('image.detail');
Route::get('/imagen/editar/{id}', [ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update', [ImageController::class, 'update'])->name('image.update');
Route::get('/imagen/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');

//Like
Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');
Route::get('/likes', [LikeController::class, 'index'])->name('likes');

//Comentario
Route::post('/comment/save', [CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
