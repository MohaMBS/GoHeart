<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    
    //Rutas para poder crear una nueva entrada en el blog.
    Route::get('/create-post',[PostController::class, 'index'])->middleware(['auth'])->name('seePost');
    Route::post('/save-post',[PostController::class, 'store'])->middleware(['auth'])->name('store.post');

    //Ruta para poder ver un post en concreto.
    Route::get('/post/{id}',[PostController::class, 'show'])->middleware(['auth'])->name('seeOne');

    //Ruta para poder editar un post.
    Route::get('/edit-post/{id}',[PostController::class, 'edit']);
});

require __DIR__.'/auth.php';

?>
