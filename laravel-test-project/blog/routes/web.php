<?php

use Illuminate\Support\Facades\Route;
use App\Models\Blogpost;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;


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
    return redirect()->route('posts.index');
});

Route::resource('posts', PostController::class);

Route::resource('categories', CategoryController::class);

// Route::get('/posts', function () {
//     return view('posts.index',[
//         'users' => User::all(),
//         'categories' => Category::all(),
//         'posts' => Post::all(),
//     ]);
// })->name('posts.index');

// Route::get('/posts/create', function () {
//     return view('posts.create');
// });

// Route::get('/posts/x', function () {
//     return view('posts.show');
// });

// Route::get('/posts/x/edit', function () {
//     return view('posts.edit');
// });

// // -----------------------------------------

// Route::get('/categories/create', function () {
//     return view('categories.create');
// });

// Route::get('/categories/x', function () {
//     return view('categories.show');
// });

// -----------------------------------------

Auth::routes();

/*
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-1', function () {
    return response("<h1>Hello world!</h1>");
})->name('login');

Route::get('/posts',function() {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('/post/{id?}',function($id = -1) {
    return view('post', [
        'post' => Blogpost::find($id)
    ]);
});

Route::get('/test-2/{id?}', function ($id = -1) {
    return  view("test-2",[
        'id' => $id,
        'name' => "Gipsz Jakab",
        "toIterate" => [
            [
                'domain' => "backend-1",
                'tech' => "php"
            ],
        ]
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/