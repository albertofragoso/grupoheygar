<?php

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
use App\Http\Middleware\CheckRoll;
use App\Http\Middleware\CheckProduct;
use App\Http\Middleware\CheckCustomer;

Route::group(['middleware' => 'auth'], function () {
  Route::get('/admin', 'PagesController@home')->middleware(CheckRoll::class);

  //Change de Controller in route
  Route::get('/customers', 'UsersController@users')->middleware(CheckRoll::class);
  Route::get('/customers/{user}', 'UsersController@detail')->middleware(CheckCustomer::class);
  Route::post('/customers/create', 'UsersController@create')->middleware(CheckRoll::class);
  Route::post('/customers/{user}/update', 'UsersController@update')->middleware(CheckRoll::class);
  Route::get('/products', 'ProductsController@products')->middleware(CheckRoll::class);
  Route::get('/products/done', 'ProductsController@done')->middleware(CheckRoll::class);
  Route::get('/products/{product}', 'ProductsController@detail')->middleware(CheckProduct::class);
  Route::post('/products/{product}/message', 'ProductsController@createMessage')->middleware(CheckProduct::class);
  Route::post('/products/create', 'ProductsController@create')->middleware(CheckRoll::class);
  Route::post('/products/{product}/update', 'ProductsController@update')->middleware(CheckRoll::class);
  Route::post('/products/{product}/delete', 'ProductsController@delete')->middleware(CheckRoll::class);
  Route::get('api/products/{product}/responses', 'ProductsController@responses')->middleware(CheckRoll::class);
  //
  Route::get('/notifications', 'UsersController@notifications');
  Route::get('/sucursales/{id}', 'UsersController@sucursales');

  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});

Auth::routes();

/*Route::post('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');*/
