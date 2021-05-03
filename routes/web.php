<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => ['cors']], function () {
    //Ruta de home
    Route::get('/',[PostController::class, 'home'])->name('home');
    
    //Rutas para poder crear una nueva entrada en el blog.
    Route::get('/blog/create-post',[PostController::class, 'create'])->middleware(['auth'])->name('create.post');
    Route::post('/blog/create-post/save-post',[PostController::class, 'store'])->middleware(['auth'])->name('store.post');

    //Ruta para poder ver un post en concreto.
    Route::get('/blog/post/{id}',[PostController::class, 'show'])->name('seeOne');

    //Ruta para poder editar un post.
    Route::get('/my-profile/my-posts/edit-post/{id}',[PostController::class, 'edit'])->middleware(['auth','postowner'])->name('edit.post');

    //Ruta para poder comentar.
    Route::post('/blog/post/comment',[CommentController::class, 'create'])->middleware(['auth'])->name('makeComment');

    //Para ver todos los posts.
    Route::get('/blog/posts',[PostController::class, 'index'])->name('posts');

    //Para poder ver y gestionar todos los posts que tiene un usuario.
    Route::get('/my-profile/my-posts',[PostController::class, 'postsUser'])->middleware(['auth'])->name('my-posts');

    //Route para poder eleminar un post.
    Route::get('/my-profile/my-posts/{id}/delete',[PostController::class, 'destroy'])->middleware(['auth','postowner'])->name('delete-post');

});

require __DIR__.'/auth.php';

?>
