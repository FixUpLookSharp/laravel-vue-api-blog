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
        //categories
        Route::get('category', 'ArticleCategoryController@index');
        Route::get('category/{dir}', 'ArticleCategoryController@show');

        //index
        Route::get('index/top-post', 'IndexController@topPost');
        Route::get('index/random-post', 'IndexController@randomPost');
        Route::get('index/top-week', 'IndexController@topWeek');

        //footer
        Route::get('footer/recent-posts', 'IndexController@recentPosts');
        Route::get('footer/top-all-time', 'IndexController@topAllTimePost');


        //likes
        Route::post('like/{article}', 'ArticleLikeController@setLike');
        Route::get('like/{article}', 'ArticleLikeController@getLike');

        //articles
        Route::resource('article', 'ArticleController', [
            'except' => ['edit', 'create']
        ]);
        Route::get('article/search/index', 'ArticleSearchController@index');
        Route::get('article/search/category/{dir}', 'ArticleSearchController@category');
        Route::get('article/search/post', 'ArticleSearchController@post');

        //comments
        Route::resource('comment', 'ArticleCommentController', [
            'except' => ['edit', 'create',]
        ]);

        //users
        Route::get('account/{user}/info', 'UserController@info');
        Route::post('block/{user}', 'LockedUserController@block');
        Route::post('unblock/{user}', 'LockedUserController@unblock');
        Route::post('explanation', 'LockedUserController@explanationBlockedUser');
        Route::get('users/', 'UserController@allUsers');
        Route::get('user/search', 'UserController@userSearch');
        Route::post('user/change-password', 'UserController@changePassword');
        Route::post('user/change-user', 'UserController@changeUser');
        Route::get('user/my-posts', 'UserController@myPosts');






    }
);
