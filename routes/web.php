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

/*----------------------------------------------Index-------------------------------------------------
/**
 * Route for check Login status
 */
Route::get('/','LoginController@checkLogin');

Route::get('index',['as' => 'getIndex','uses' => 'LoginController@checkLogin']);
/**
 * Route for check username and password
 */
Route::get('login',['as' => 'getLogin','uses' => 'LoginController@getLogin']);
/**
 * Route for logout
 */
Route::get('logout',['as' => 'getLogout','uses' => 'LoginController@getLogout']);
/*-----------------------------------------------Manager------------------------------------------------
/**
 * Route for location to manager page
 */
Route::get('manage',['as' => 'getManager','uses' => 'ManagerController@checkAccount']);
/*-----------------------------------------------Account Manager------------------------------------------------
/**
 * Route for add new account
 */
Route::get('manage/add',['as' => 'addAccount','uses' => 'ManagerController@addAccount']);
/**
 * Route for add delete account
 */
Route::get('manage/delete',['as' => 'delAccount','uses' => 'ManagerController@delAccount']);
/*-----------------------------------------------Account Manager------------------------------------------------
/**
 * Route for add location new goods page
 */
Route::get('addGoods',['as' => 'locationAddGoods','uses' => 'ManagerController@locationAddGoods']);
/**
 * Route for add location repair add goods page
 */
Route::get('hisAddGoods',['as' => 'locationHisAddGoods','uses' => 'ManagerController@locationHisAddGoods']);
/**
 * Route for add location history goods page
 */
Route::get('managerGoods',['as' => 'locationManagerGoods','uses' => 'ManagerController@locationManagerGoods']);
/**
 * Route for add new goods
 */
Route::get('addGoods/add',['as' => 'addGoods','uses' => 'ManagerController@addGoods']);
/**
 * Route for add search goods
 */
Route::get('managerGoods/search',['as' => 'searchGoods','uses' => 'ManagerController@searchGoods']);
/*-----------------------------------------------------------------------------------------------
/**
 * Route for location to statistical page
 */
Route::get('statistical',['as' => 'getStatistical','uses' => 'ManagerController@locationStatistical']);
/*-----------------------------------------------Guest------------------------------------------------
/**
 * Route for location to statistical page
 */
Route::get('guestManager',['as' => 'locationGuestManager','uses' => 'ManagerController@locationGuestManager']);
/**
 * Route for add new account
 */
Route::get('guestManager/add',['as' => 'addGuest','uses' => 'ManagerController@addGuest']);
/**
 * Route for add delete account
 */
Route::get('guestManager/delete',['as' => 'delGuest','uses' => 'ManagerController@delGuest']);
/**
 * Route for add cart
 */
Route::get('manage/addGoodsToCart',['as' => 'addGoodsToCart','uses' => 'ManagerController@addToCart']);
/**
 * Route for load cart
 */
Route::get('manage/cart',['as' => 'loadCart','uses' => 'ManagerController@loadCart']);
/**
 * Route for pay
 */
Route::get('manage/pay',['as' => 'pay','uses' => 'ManagerController@pay']);/**
/**
* Route for pay
*/
Route::get('order',['as' => 'locationOrder','uses' => 'ManagerController@locationOrder']);
/**
* Route for order detail
*/
Route::get('order/detail',['as' => 'orderdetail','uses' => 'ManagerController@orderdetail']);

