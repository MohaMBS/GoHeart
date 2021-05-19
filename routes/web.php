<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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


    //Ruta de home
    Route::get('/',[PostController::class, 'home'])->name('home');
    
    //Ruta del blog
    Route::get('/blog/post/create',[PostController::class, 'create'])->middleware(['auth'])->name('create.post');//Rutas para poder crear una nueva entrada en el blog.
    Route::post('/blog/post/create/save-post',[PostController::class, 'store'])->middleware(['auth'])->name('store.post');//Rutas para editar una nueva entrada en el blog.
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
    Route::get('/blog/event/{id}',[EventController::class, 'show'])->name('see-event'); // Ruta para ver el evento.
    Route::get('/my-profile/my-events',[UserController::class,'myEvents'])->name('my-events')->middleware(['auth']); //Ruta para poder mis eventos.
    Route::get('my-profile/my-posts/edit-event/{id}',[EventController::class,'edit'])->name('edit-evnet')->middleware(['auth','eventowner']); //Ruta para poder editar un evento.
    Route::post('blog/evnet/save/{id}',[EventController::class, 'updateEvent'])->name('update-event')->middleware(['auth','eventowner']); //Ruta para guarar los cambios de un evento.
    Route::post('blog/event/{id}/comment',[EventController::class, 'comment'])->name('comment-event')->middleware(['auth']);// Ruta para comentar en un evento.
    Route::post('blog/event/{id}/comment/delete',[EventController::class, 'destroy'])->name('delet-comment-event')->middleware(['auth']);// Ruta para borrar un comentrio de un evento.
    Route::post('blog/event/delet/comment/{id}',[EventController::class, 'destroy'])->name('delet-not-my-comment-event')->middleware(['auth']);// Ruta para borrar los comentarios de un evento tuyo.)
    Route::get('blog/delete/event/{id}',[EventController::class, 'deleteEvent'])->name('delete-event')->middleware(['auth','eventowner']);// Para eliminar un evneto.
    
    //Rusta para las funciones basicas de la web
    Route::get('contact-us',[ContactController::class,'index'])->name('form-contact'); // Ruta que lleva a la vista para el formulario de contacto 
    Route::post('contact-us',[ContactController::class,'send'])->name('send-contact'); // Ruta para enviar la consulta 
    Route::get('blog/search={value}',[PostController::class,'search'])->name('blog-search');

    //Rutas para la gestion de admin
    Route::get('admin/delete/post/{id}',[AdminController::class,'deletePost'])->name('admin.delete-post')->middleware(['auth','myadmin']); //Ruta para solo aquellos admin para poder borrar una entrada
    Route::get('admin/disable/post/{id}',[AdminController::class,'disablePost'])->name('admin.disable-post')->middleware(['auth','myadmin']); //Ruta de admin para desabilitar una entrada
    Route::get('admin/disable/event/{id}',[AdminController::class,'disableEvent'])->name('admin.disable-event')->middleware(['auth','myadmin']); //Ruta de admin para desabilitar un evento
    Route::post('admin/post/delete/comment/{id}',[AdminController::class,'deleteCommentPost'])->name('admin.delete-comment-post')->middleware(['auth','myadmin']);//Ruta para poder eliminar los comentarios de las entradas
    Route::post('admin/event/delete/comment/{id}',[AdminController::class,'deleteCommentEvent'])->name('admin.delete-comment-event')->middleware(['auth','myadmin']); //Rura para poder eliminar los comentarios de los eventos
    Route::get('admin/delete/event/{id}',[AdminController::class,'deleteEvent'])->name('admin.delete-event')->middleware(['auth','myadmin']); //Ruta de admin para borrar entradasd
require __DIR__.'/auth.php';

?>
