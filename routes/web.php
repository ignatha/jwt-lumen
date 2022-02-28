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

$router->group(['prefix' => 'api/'], function () use ($router) {
		$router->post('register/','UserController@register');
   		$router->post('login/','UserController@authenticate');
   		$router->post('logout/','UserController@logout');
		$router->post('product/','ProductController@store');
		$router->get('product/', 'ProductController@index');
		$router->get('product/{id}/', 'ProductController@show');
		$router->put('product/{id}/', 'ProductController@update');
		$router->delete('product/{id}/', 'ProductController@destroy');
});