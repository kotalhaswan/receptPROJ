<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/recipes', [App\Http\Controllers\RecipeController::class, 'recipes'])->name('recipes');
Route::get('add-recipe-post-form', [PostController::class, 'index']);
Route::post('store-form', [PostController::class, 'store'])->name('store-form');
Route::get('delete-recipe', [DeleteController::class, 'index'])->name('delete');
Route::get('delete/{id}', [DeleteController::class, 'destroy']);

// Route::any ( '/search', function () {
//     $q = Input::get ( 'q' );
//     $recipes = Recipe::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'origin', 'LIKE', '%' . $q . '%' )->get ();
//     if (count ( $recipes ) > 0)
//         return view ( 'search-view' )->withDetails ( $recipes )->withQuery ( $q );
//     else
//         return view ( 'search-view' )->withMessage ( 'No Details found. Try to search again !' );
// } );
// Route::get('delete-recipe', 'App\Http\Controllers\Api\DeleteController@delete');
// Route::get('delete/{id}','DeleteController@destroy');
