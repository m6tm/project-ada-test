<?php

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
    $user = User::find(1);
    $token = $user->createToken('new_connexion_' . str_shuffle(substr((string) time(), 0, 8)))->plainTextToken;
    auth()->login($user);
    
    return response()->json([
        'code' => 200,
        'token' => $token
    ]);
});
