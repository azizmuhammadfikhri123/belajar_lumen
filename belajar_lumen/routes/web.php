<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/product', 'ProductController@index');
$router->post('/product', 'ProductController@create');
$router->post('/product/{id}', 'ProductController@update');
$router->get('/product/{id}', 'ProductController@destroy');

/*
// $router->get('/key', function () {
//     return str_random(32);
// });

// Basic 
// $router->get('/foo', function () {
//     return 'Method GET!';
// });

// $router->post('/pos', function () {
//     return 'Method POST!';
// });

// $router->put('/put-method', function () {
//     return 'Method PUT!';
// });

// $router->patch('/patch-method', function () {
//     return 'Method Patch!';
// });

// $router->delete('/delete-method', function () {
//     return 'Method Delete!';
// });

// Basic Route Parameter
// $router->get('/user/{id}', function ($id) {
//     return 'User id = ' . $id;
// });

// $router->get('/post/{postId}/comments/{commentId}', function ($postId, $commentId) {
//     return 'Post Id = ' . $postId . ' ,Comment Id = ' . $commentId;
// });

// // Optional Route Parameter
// $router->get('/optional[/{param}]', function ($param = null) {
//     return $param;
// });

// // Group Prefix
// $router->group(['prefix' => 'adminHero'], function () use ($router) {
//     $router->get('home', function () {
//         return 'Home Admin';
//     });

//     $router->get('profile', function () {
//         return 'Profile Admin';
//     });
// });

// $router->get('hero/admin', ['as' => 'route.hero', function () {
//     return route('route.hero');
// }]);

// //
// $router->get('/admin/home', ['middleware' => 'age', function () {
//     return 'Berhasil';
// }]);

// $router->get('/fails', function () {
//     return 'Not yet mature / Gagal';
// });

// $router->get('/heros/{id}', 'ExampleController@getHero');

// $router->get('/cat/{cat1}/cat2/{cat2}', 'ExampleController@getCategory');

// $router->get('/key', 'ExampleController@generateKey');
*/