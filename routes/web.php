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
Route::get('testdb', 'dbtest@test');
Route::get('test', 'TestController@index');
Route::get('testdb/{id}', 'dbtest@get_id');
Route::any('updateRole','dbtest@updateRole');
Route::any('blog','BlogController@index');
Route::any('blogcreate','BlogController@create')->middleware('auth');
Route::any('blogstore','BlogController@store')->name('blog.create');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['web']], function () {
    Route::resource('user', 'UserController');
    Route::auth();
});

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware'=>['auth','checkrole']],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');

    $router->get('dash', 'DashboardController@index');
    $router->get('home', 'HomeController@index');
    // 菜单
    require(__DIR__ . '/admin/menu.php');
    // 权限
    require(__DIR__ . '/admin/permissions.php');
    // 组件
    require(__DIR__ . '/admin/compose.php');
    // 权限
    require(__DIR__ . '/admin/role.php');
    // 控制器
    require(__DIR__ . '/admin/contro.php');
    //用户
    require(__DIR__ . '/admin/user.php');
});