<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => '/v1'], function(){
    Route::post('login', "LoginController@login");

});

Route::group([ 'namespace' => 'Manager'], function () {
    Route::resource('setting', "SettingController"); //站点设置
    Route::resource('message', "MessageController"); //留言
    Route::resource('article/category', "ArticleCategoryController"); //文章分类
    Route::resource('article', "ArticleController"); //文章详情
    Route::resource('friendship', "FriendshipController"); //友情链接

});

Route::group([ 'namespace' => 'Manager'], function () {

    Route::post('upload',"CommonController@upload"); // 上传文件

});


