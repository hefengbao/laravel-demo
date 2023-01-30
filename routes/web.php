<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function (){
    //Route::resource('/users', \App\Http\Controllers\UserController::class);
});

/*Route::get('/users',[\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');*/

Route::resource('/users', \App\Http\Controllers\UserController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('mail/post-commented', function (){
    $post = \App\Models\Post::find(1);

    $user = \App\Models\User::find(1);

    $comment = new \App\Models\Comment();
    $comment->body = '评论测试';
    $comment->user()->associate($user);
    $comment->post()->associate($post);
    $comment->save();

    \App\Jobs\PostCommented::dispatch($comment);

    //\Illuminate\Support\Facades\Mail::to('')->send(new \App\Mail\PostCommented($comment));
});
