<?php

use Illuminate\Support\Facades\Route;
use App\Models\Memo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 登録処理
Route::post('/memos', [App\Http\Controllers\MemosController::class, 'store']);

// メモ一覧表示
Route::get('/main', [App\Http\Controllers\MemosController::class, 'memosIndex']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
