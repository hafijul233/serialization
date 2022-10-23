<?php

use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', function () {

    return UserResource::collection(User::paginate());

})->name('users.index');

Route::get('users/{user}', function (User $user) {

    return new UserResource($user);

})->name('users.show');

Route::get('roles', function () {

    return RoleResource::collection(Role::paginate());

})->name('roles.index');

Route::get('roles/{id}', function (Role $role) {

    return (new RoleResource($role))->additional([]);

})->name('roles.show');
