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
    // return view('welcome');
    return redirect()->route('login');
});

Route::prefix('auth')->group(function () {
    Route::get('login', 'Auth\LoginController@index')->name('login')->middleware('guest');
    Route::post('login', 'Auth\LoginController@authenticate')->name('login.auth.custom');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout.auth.custom');

    Route::get('register', 'PagesController@register')->name('register_form');
    Route::post('register/store', 'Auth\RegisterController@store')->name('register.store');
});

Route::get('verify/{validation_code}', 'UserController@verify');
Route::get('thanks', function () {
    return view('thanks');
})->name('thanks');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    // note: Dashboard welcome user operational login
    Route::get('welcome', 'DashboardController@index_welcome')->name('dashboard.index_welcome');

    Route::prefix('users')->group(function () {
        Route::get('', 'UserController@index')->name('dashboard.user.index');
        Route::get('create', 'UserController@create')->name('dashboard.user.create');
        Route::get('edit/{id}', 'UserController@edit')->name('dashboard.user.edit');
        Route::post('store', 'UserController@store')->name('dashboard.user.store');
        Route::post('update/{id}', 'UserController@update')->name('dashboard.user.update');
        Route::post('delete/{id}', 'UserController@destroy')->name('dashboard.user.destroy');

        // todo Management Roles
        Route::prefix('roles')->group(function () {
            Route::get('/', 'RoleController@index')->name('dashboard.role.index');
            Route::get('edit-permission/{id}', 'RoleController@edit_permission')->name('dashboard.role.edit_permission');
            Route::post('udpate-permission/{id}', 'RoleController@update_permission')->name('dashboard.role.update_permission');
            Route::post('/', 'RoleController@store')->name('dashboard.role.store');
            Route::post('update/{id}', 'RoleController@update')->name('dashboard.role.update');
            Route::post('delete/{id}', 'RoleController@destroy')->name('dashboard.role.delete');
        });

        // todo Management Permissions
        Route::prefix('permissions')->group(function () {
            Route::get('/', 'PermissionController@index')->name('dashboard.permission.index');
            Route::post('/', 'PermissionController@store')->name('dashboard.permission.store');
            Route::post('update/{id}', 'PermissionController@update')->name('dashboard.permission.update');
            Route::post('delete/{id}', 'PermissionController@destroy')->name('dashboard.permission.delete');
        });

        Route::prefix('operationals')->group(function () {
            Route::get('', 'UserController@index_operationals')->name('dashboard.operational.index');
        });
    });
});
