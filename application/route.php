<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::resource('api/category','admin/category');
Route::resource('api/upload','admin/upload');
Route::resource('api/goods','admin/goods');
Route::resource('api/reserve','admin/reserve');

//琴台页面
Route::resource('api/index','index/index');
Route::resource('api/categoryfront','index/category');
Route::resource('api/goodsfront','index/goods');
Route::resource('api/usersfront','index/users');
Route::resource('api/loginfront','index/login');
Route::resource('api/cartfront','index/cart');
Route::resource('api/shopfront','index/shop');
Route::resource('api/ordersfront','index/orders');
Route::resource('api/address','index/address');

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
