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


Route::group(['middleware' => 'auth'], function(){
    Route::get('/','PagesController@showDashboard');
    Route::get('/order/test', function(){
       return view('order.test');
    });
    Route::post('/password/reset/internal', 'HomeController@resetInternal');
    Route::get('/dashboard','PagesController@showDashboard');
    Route::get('/order/create','OrderController@showForm');
    Route::post('/order/create/post','OrderController@postForm');
    Route::get('/user/settings','PagesController@getUserSettings');
    Route::post('/user/settings/post','PagesController@postUserSettings');
});

Route::group(['prefix' => 'admin'], function(){
    //uses admin middleware, prefixed /admin/
    Route::get('/users','AdminController@showUsers')->middleware(['auth','magikarp']);
    Route::get('/settings','AdminController@showAdminSettings')->middleware(['auth','magikarp']);
    Route::get('/orders', 'AdminController@showOrders')->middleware(['auth','magikarp']);

    Route::get('/settings/post','AdminController@postAdminSettings')->middleware(['auth','magikarp']);
    Route::get('/create/user','AdminController@showCreateUserForm')->middleware(['auth','magikarp']);
    Route::post('/create/user/post','AdminController@createUser')->middleware(['auth','magikarp']);
    Route::get('/edit/{user}','AdminController@showEditForm')->middleware(['auth','magikarp']);
    Route::put('/edit/{user}/post','AdminController@editUser')->middleware(['auth','magikarp']);
    Route::delete('/delete/user/{user}','AdminController@deleteUser')->middleware(['auth','magikarp']);
    

});

    // Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout');

// Registration Routes... - DISABLED
//$this->get('register', 'Auth\RegisterController@showRegistrationForm');
//$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/api/products/get','apiController@getProducts');