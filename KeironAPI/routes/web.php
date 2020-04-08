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

$router->group(['prefix'=>'api/v1'], function() use($router){
$router->get('/usuarios', 'UserController@index');
$router->post('/usuarios', 'UserController@create');
$router->get('/usuarios/{id}', 'UserController@show');
$router->put('/usuarios/{id}', 'UserController@update');
$router->delete('/usuarios/{id}', 'UserController@destroy');

$router->post('/login', 'LoginController@login');

$router->get('/tickets', 'TicketController@index');
$router->post('/tickets', 'TicketController@create');
$router->delete('/tickets/{id}', 'TicketController@destroy');
$router->get('/tickets/{id}', 'TicketController@show');
$router->put('/tickets/{id}', 'TicketController@update');

});