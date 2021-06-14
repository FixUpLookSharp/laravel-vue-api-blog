<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers\Api\Auth',
        'prefix'     => 'auth',
    ],
    function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
        Route::post('refresh', 'AuthController@refresh');
    }
);

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers\Api\V1',
        'prefix'     => 'V1',
    ],

    function () {
        Route::get('category', 'ArticleCategoryController@index');
        Route::get('category/{dir}', 'ArticleCategoryController@show');


        Route::get('index/top-post', 'IndexController@topPost');
        Route::get('index/random-post', 'IndexController@randomPost');
        Route::get('index/top-week', 'IndexController@topWeek');


        Route::post('like/{article}', 'ArticleLikeController@setLike');
        Route::get('like/{article}', 'ArticleLikeController@getLike');
        Route::resource('article', 'ArticleController', [
            'except' => ['edit', 'create']
        ]);
        Route::resource('comment', 'ArticleCommentController', [
            'except' => ['edit', 'create',]
        ]);

        Route::get('account/{user}/info', 'UserController@info');

    }
);
