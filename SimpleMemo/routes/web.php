<?php

use Illuminate\Support\Facades\Route;
use App\Models\Memo;
use Auth; // 認証機能を使用

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

// 編集画面
Route::get('/memosedit/{memos}', function (Memo $memos) {
    return view('memosedit', ['memo'=>$memos]);
});

// 編集機能
Route::post('/memos/update', [App\Http\Controllers\MemosController::class, 'update']);

// 削除機能
Route::delete('/memos/{memo}', [App\Http\Controllers\MemosController::class, 'destroy']);

Auth::routes();

// ログイン認証がされている場合は「/main」に遷移、そうでない場合はログイン画面へ遷移するように変更
Route::get('/home', function () {
    if (Auth::check()) {
        return redirect('/main');
    } else {
        return view('auth.login');
    }
})->name('home');
