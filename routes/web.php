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

$router->post('pet', [
    'uses' => 'PetController@store'
]);

// $router->put('pet[/{pet}]', [
//     'uses' => 'PetController@update'
// ]);

$router->get('pet/findByStatus', [
    'uses' => 'PetController@findByStatus'
]);

$router->get('pet/{id}', [
    'uses' => 'PetController@show'
]);

$router->post('pet/{id}', [
    'uses' => 'PetController@update'
]);

$router->delete('pet/{id}', [
    'uses' => 'PetController@destroy'
]);

$router->post('pet/{id}/uploadImage', [
    'uses' => 'PetController@upload',
]);

$router->get('store/inventory', [
    'uses' => 'StoreController@inventory',
]);

$router->post('store/order', [
    'uses' => 'StoreController@order',
]);

$router->get('store/order/{id}', [
    'uses' => 'StoreController@findOrder',
]);

$router->delete('store/order/{id}', [
    'uses' => 'StoreController@destroy',
]);
