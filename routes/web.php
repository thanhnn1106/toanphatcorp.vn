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
// ADMIN ROUTER
Route::group([
    'namespace'    => 'Admin',
    'prefix'       => 'cpanel',
    'as'           => 'admin.',
    'middleware'   => 'web'
], function ($router) {
    // Authentication Routes...
      $router->get('login', 'AuthController@showLoginForm')->name('login');
      $router->post('login', 'AuthController@login');
      $router->get('logout', 'AuthController@logout')->name('logout');

//        $router->get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot');
//        $router->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('send_reset_email');
//        $router->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset_form');
//        $router->post('password/reset', 'Auth\ResetPasswordController@reset')->name('reset_password');

    $router->group([
        'middleware' => ['auth.admin'],
    ], function ($router) {
        $router->get('/', [
            'as'   => 'dashboard',
            'uses' => 'DashBoardController@index',
        ]);
    });

});
