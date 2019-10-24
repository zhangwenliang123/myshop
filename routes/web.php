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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/index','IndexController@index');
Route::any('/add','IndexController@add');
Route::any('/delete','IndexController@delete');
Route::any('/update','IndexController@update');
Route::any('/update_do','IndexController@update_do');
Route::any('/del','IndexController@del');

Route::any('/model','ViewController@model');
Route::any('/register','IndexController@register');

Route::any('/register_do','IndexController@register_do');
Route::any('/login','IndexController@login');
Route::any('/login_do','IndexController@login_do');

Route::any('/','ShowController@show');
Route::any('/show','ShowController@show');
Route::any('/add_do','ShowController@add_do');

//=====电商======
//登录
Route::any('/buthlogin','Buth\ButhIndexController@buthlogin');
//注册
Route::any('/buthregist','Buth\ButhIndexController@buthregist');
Route::any('/buthregist_do','Buth\ButhIndexController@buthregist_do');
//显示商品页面
Route::any('/buthindex','Buth\ButhIndexController@buthindex');
//购物车
Route::any('/buthcart','Buth\ButhIndexController@buthcart');
//商品信息
Route::any('/buthexit','Buth\ButhIndexController@buthexit');
//产品列表
Route::any('/buthprolist','Buth\ButhIndexController@buthprolist');
//订单管理
Route::any('/buthorders','Buth\ButhIndexController@buthorders');
//购物车结算
Route::any('/buthinfo','Buth\ButhIndexController@buthinfo');

//考试
Route::any('/missadd','MissController@missadd');
Route::any('/missindex','MissController@missindex');
Route::any('/missexit','MissController@missexit');


//微信缓存
Route::any('/indexa','WechatController@indexa');
//微信用户获取
Route::any('/wechat_add','WechatController@wechat_add');
Route::any('/wechat_list','WechatController@wechat_list');
//网友授权
Route::any('/wechat_login','WechatController@wechat_login');
Route::any('/author','WechatController@author');
Route::any('/getUserInfo','WechatController@getUserInfo');
//模板接口
Route::any('/push_template_msg','WechatController@push_template_msg');
//查看标签
Route::any('/weixinlist','WechatController@weixinlist');
//jS-SDK
Route::any('/get_location','WechatController@get_location');


//get请求
Route::any('/get','WechatController@get');
//post请求
Route::any('/post','WechatController@post');
Route::any('/aadd','WechatController@aadd');


Route::any('/event','EventController@event');


//标签管理
Route::any('/tag_list','Tagcontroller@tag_list');
Route::any('/add_tag','TagController@add_tag');
Route::post('/do_add_tag','TagController@do_add_tag');
//微信素材文件上传
Route::any('/uploads','ResourceController@uploads');
Route::any('/do_uploads','ResourceController@do_uploads');
Route::any('/source_list','ResourceController@source_list');

//菜单列表
Route::any('/menu_list','MenuController@menu_list');
Route::any('/create_menu','MenuController@create_menu');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
