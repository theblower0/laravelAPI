<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('users/addUser','UserController@addUser');
$router->post('users/login','UserController@login');

$router->post('orders/addOrder','OrdersController@addOrder');
$router->get('orders/viewOrdersWithDetail','OrdersController@viewOrdersWithDetail');
$router->get('orders/viewOrders','OrdersController@viewOrders');
$router->post('orders/deleteOrder','OrdersController@deleteOrder');
$router->get('orders/deleteOrder','OrdersController@deleteOrder');

$router->post('detailOrder/addDetailOrder','DetailOrderController@addDetailOrder');
$router->get('menu/viewProducts','MenuController@viewProducts');

$router->group(['middleware' => 'auth'], function() use($router){
    $router->get('users/view','UserController@view');
    $router->get('users/user', function() use ($router){
        return auth()->user();
    });
    $router->post('users/logout','UserController@logout');

    $router->post('menu/addProduct','MenuController@addProduct');
   
    $router->post('menu/deleteProduct','MenuController@deleteProduct');
    $router->post('menu/updateProduct','MenuController@updateProduct');

    
    
});