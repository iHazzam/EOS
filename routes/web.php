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

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    //uses admin middleware, prefixed /admin/
    Route::get('/dashboard/stats','AdminController@showAdminStats');
    Route::get('/users','AdminController@showUsers');
    Route::get('/settings/','AdminController@showAdminSettings');
    Route::get('/settings/post','AdminController@postAdminSettings');

    Route::get('/create/user','AdminController@showCreateUserForm');
    Route::post('/create/user/post','AdminController@createUser');
    Route::get('/edit/{user}','AdminController@showEditForm');
    Route::put('/edit/{user}/post','AdminController@editUser');
    Route::delete('/delete/user/{user}','AdminController@deleteUser');
    

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


