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
// AUTH ROUTER
Route::group([
    'as'           => 'auth.',
    'middleware'   => 'web'
], function ($router) {
    $router->group([
        'middleware' => ['guest'],
    ], function ($router) {
        $router->get('auth/{service}', [
            'as'   => 'facebook',
            'uses' => 'Auth\AuthController@redirectToProvider'
        ]);

        $router->get('auth/{service}/callback', [
            'as'   => 'facebook_callback',
            'uses' => 'Auth\AuthController@handleProviderCallback'
        ]);
    });
});

// FRONT ROUTER
Route::group([
    'as'           => 'front.',
    'middleware'   => 'web'
], function ($router) {
    $router->group([
        'middleware' => ['auth.front'],
    ], function ($router) {
        $router->get('/', [
            'as'   => 'home',
            'uses' => 'Front\HomeController@index'
        ]);
        $router->get('/redirect', [
            'as'   => 'redirect',
            'uses' => 'Front\HomeController@redirect'
        ]);
        $router->get('/category/{slug}', [
            'as'   => 'category_detail',
            'uses' => 'Front\CategoryController@detail'
        ]);
        $router->get('/tag/{slug}', [
            'as'   => 'tag_detail',
            'uses' => 'Front\CategoryController@detail'
        ]);
        $router->post('/files/download', [
            'as'   => 'files_download',
            'uses' => 'Front\FilesController@normalDownload'
        ]);
    });
});

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
        Route::get('manage-package', 'PackagesController@index')->name('package');
        Route::match(['get', 'post'], 'manage-package/add', 'PackagesController@add')->name('package_add');
        Route::post('manage-package-view', 'PackagesController@view')->name('package_view');
        Route::match(['get', 'post'], 'manage-package/edit/{id?}', 'PackagesController@edit')->name('package_edit');
        Route::match(['get', 'post'], 'manage-package/delete/{id?}', 'PackagesController@delete')->name('package_delete');
        // Admin manage caterogies
        $router->get('category', [
            'as'   => 'category',
            'uses' => 'CategoryController@index',
        ]);
        $router->match(['get', 'post'], 'category/add', [
            'as'   => 'category.add',
            'uses' => 'CategoryController@add',
        ]);
        $router->match(['get', 'post'], 'category/edit/{categoryId}', [
            'as'   => 'category.edit',
            'uses' => 'CategoryController@edit',
        ]);
        $router->get('category/delete/{categoryId}', [
            'as'   => 'category.delete',
            'uses' => 'CategoryController@delete',
        ]);
        // Admin manage files
        $router->get('files', [
            'as'   => 'files',
            'uses' => 'FilesController@index',
        ]);
        $router->match(['get', 'post'], 'files/add', [
            'as'   => 'files.add',
            'uses' => 'FilesController@add',
        ]);
        $router->match(['get', 'post'], 'files/edit/{fileId}', [
            'as'   => 'files.edit',
            'uses' => 'FilesController@edit',
        ]);
        $router->get('files/delete/{fileId}', [
            'as'   => 'files.delete',
            'uses' => 'FilesController@delete',
        ]);
        // Admin manage users
        $router->get('users', [
            'as'   => 'users',
            'uses' => 'UsersController@index',
        ]);
        $router->match(['get', 'post'], 'users/add', [
            'as'   => 'users.add',
            'uses' => 'UsersController@add',
        ]);
        $router->match(['get', 'post'], 'users/edit/{userId}', [
            'as'   => 'users.edit',
            'uses' => 'UsersController@edit',
        ]);
        $router->match(['get', 'post'], 'users/delete/{userId}', [
            'as'   => 'users.delete',
            'uses' => 'UsersController@delete',
        ]);
        // Admin manage admins
        $router->get('admins', [
            'as'   => 'admins',
            'uses' => 'AdminsController@index',
        ]);
        $router->match(['get', 'post'], 'admins/add', [
            'as'   => 'admins.add',
            'uses' => 'AdminsController@add',
        ]);
        $router->match(['get', 'post'], 'admins/edit/{adminId}', [
            'as'   => 'admins.edit',
            'uses' => 'AdminsController@edit',
        ]);
        $router->match(['get', 'post'], 'admins/delete/{adminId}', [
            'as'   => 'admins.delete',
            'uses' => 'AdminsController@delete',
        ]);
    });
});
