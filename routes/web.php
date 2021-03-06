<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::resource('books', 'BooksController');
Route::post('/books/{book}/rate', 'BookController@rate')->name('books.rate');
Route::get('/authors/{author}', 'AuthorsController@result')->name('authors.show');
Route::get('/publishers/{publisher}', 'PublishersController@result')->name('publishers.show');
Route::get('/categories/{category}', 'CategoriesController@result')->name('categories.show');
