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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses' => 'MahasiswaController@getAllMahasiswa']);
    $router->get('/profile', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@profile']);
    $router->get('/{nim}', ['uses' => 'MahasiswaController@nimprofile']);
    $router->post('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@addMatakuliah']);
    $router->put('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@delMatakuliah']);
    // $router->get('/profile', ['uses' => 'MahasiswaController@profile']);
});

$router->group(['prefix' => 'matakuliah'], function () use ($router) {
    // $router->get('/', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@getMatakuliahMahasiswa']);
    $router->post('/{mkId}', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@addMatakuliah']);
});

$router->get('/matakuliah', ['uses' => 'MahasiswaController@allMatakuliah']);


// $router->group(['prefix' => 'mahasiswas'], function () use ($router) {
//     $router->post('/', ['uses' => 'MahasiswaController@createMahasiswa']);
//     $router->get('/{id}', ['uses' => 'PostController@getPostById']);
//     $router->put('/{id}/tag/{tagId}', ['uses' => 'PostController@getPostById']); //
// });

// $router->get('/', ['middleware' => 'jwt.auth', 'uses' => 'HomeController@home']);

// $router->group(['prefix' => 'auth'], function () use ($router) {
//     $router->post('/register', ['uses' => 'AuthController@register']);
//     $router->post('/login', ['uses' => 'AuthController@login']);
// });

// $router->group(['prefix' => 'mahasiswa'], function () use ($router) {
//     $router->get('/', ['uses' => 'MahasiswaController@allmhs']);
//     $router->get('/profile', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@profile']);
//     $router->get('/{nim}', ['uses' => 'MahasiswaController@nimprofile']);
//     $router->post('/{nim}/matakuliah/{mkId}', ['uses' => 'MahasiswaController@addmatkul']);
// });
