<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/a', [UserController::class, 'index']);
Route::get('/users', function () {
    return $post = ([
        'post' =>  User::all()->where('status', '!=', '1')
    ]);
});
Route::get('/users/{id}', [UserController::class, 'showuser']);
Route::get('/users/bydate', [UserController::class, 'show']);
Route::post('/users/register', [UserController::class, 'create']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/delete', [UserController::class, 'destroy']);
