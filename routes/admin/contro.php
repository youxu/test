<?php
$router->get('contro/create/{id}', 'ControsController@create');
$router->get('contro/index/{id}', 'ControsController@index');
//方法列表
$router->get('contro/list_method/{id}', 'ControsController@list_method');
$router->post('contro/store_method', 'ControsController@store_method');
$router->post('contro/update_method', 'ControsController@update_method');
$router->resource('contro','ControsController');

