<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
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
    
    //Ruta del blog
    Route::get('/blog/post/create-post',[PostController::class, 'create'])->middleware(['auth'])->name('create.post');//Rutas para poder crear una nueva entrada en el blog.
    Route::post('/blog/post/create-post/save-post',[PostController::class, 'store'])->middleware(['auth'])->name('store.post');//Rutas para editar una nueva entrada en el blog.
    Route::get('/blog/post/{id}',[PostController::class, 'show'])->name('seeOne');//Ruta para poder ver un post en concreto.
    Route::get('/my-profile/my-posts/edit-post/{id}',[PostController::class, 'edit'])->middleware(['auth','postowner'])->name('edit.post');//Ruta para poder editar un post.
    Route::post('/blog/post/comment',[CommentController::class, 'create'])->middleware(['auth'])->name('makeComment');//Ruta para poder comentar.
    Route::get('/blog/posts',[PostController::class, 'index'])->name('posts');//Para ver todos los posts.
    Route::get('/my-profile/my-posts/{id}/delete',[PostController::class, 'destroy'])->middleware(['auth','postowner'])->name('delete-post'); //Route para poder eleminar un post.
    Route::post('/blog/post/{id}/delete/comment/{cid}',[CommentController::class, 'destroy'])->middleware(['auth','postowner'])->name('delete.comment');//Para eliminar un mensaje de un usuario en tu post.
    Route::post('/blog/post/{id}/delete/message', [CommentController::class, 'deleteMessage'])->middleware(['auth'])->name('delete.my.comment');//Ruta para eliminar tus propios mensajes.
    
    //Ruta para reacciones a las entradas
    Route::post('/blog/post/{id}/save', [PostController::class,'savePost'])->middleware(['auth'])->name('save.post');//Rute para guardar un post.
    Route::post('/blog/post/{id}/fovirte', [PostController::class,'favoritePost'])->middleware(['auth'])->name('favorite.post');//Rute para "favoritar" un post.
    Route::post('/blog/post/{id}/report', [ReportController::class,'store'])->middleware(['auth'])->name('report.post');//Rute para hacer un reporte a un post.


    //Routa para el perfil de usuario
    Route::post('/my-profile/deleteAcount/{id}',[UserController::class,'destroy'])->name('delet-user')->middleware(['auth']);//Ruta para poder eliminar la cuenta del usuario.
    Route::get('/my-profile/my-posts',[PostController::class, 'postsUser'])->middleware(['auth'])->name('my-posts');//Para poder ver y gestionar todos los posts que tiene un usuario.
    Route::get('/my-profile', [UserController::class,'index'])->name("edit-user")->middleware(['auth']);//Ruta para poder llegar a la seccion para editar el perfil del usuairo.
    Route::post('/my-profile',[UserController::class, 'update'])->name('update-profile')->middleware(['auth']);//Ruta para cambiar los datos personales de la perosna.
    Route::post('/my-profile/avatar', [UserController::class,'changeAvatar'])->name('change-avatar')->middleware(['auth']); //Ruta para cambiar el avatar
    Route::get('/my-profile/my-favorites', [UserController::class,'fovritesPost'])->name('my-favorites')->middleware(['auth']); //Ruta para cambiar el avatar
    Route::get('/my-profile/my-saves', [UserController::class,'savedPost'])->name('my-saves')->middleware(['auth']); //Ruta para cambiar el avatar

    //Rutas para eventos
    Route::get('/blog/events',[EventController::class,'index'])->name('events'); //Ruta para ver los eventos
    Route::get('/blog/event/create',[EventController::class,'create'])->name('create-event')->middleware(['auth']); //Ruta para crear un evento.
    Route::post('/blog/event/save',[EventController::class,'store'])->name('save-event')->middleware(['auth']);// Ruta para guardar el evento. 
    Route::get('/blog/event/{id}',[EventController::class, 'show'])->name('see-event')->middleware(['auth']); // Ruta para ver el evento.
    Route::get('/my-profile/my-events',[UserController::class,'myEvents'])->name('my-events')->middleware(['auth']); //Ruta para poder mis eventos.
    dd("acab el tema de los eventos, haz el buscador y hay que hacer el backend de admin");
});
require __DIR__.'/auth.php';

?>
