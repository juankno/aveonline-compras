<?php

use App\Http\Resources\Api\V1\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');

    Route::apiResource('roles', 'RoleController');
    Route::apiResource('users', 'UserController');
    Route::apiResource('products', 'ProductController');
    Route::apiResource('customers', 'CustomerController');
    Route::apiResource('orders', 'OrderController');
});
