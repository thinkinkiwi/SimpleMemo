<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 下記内容を追記
use App\Models\Memo;  // Memoモデルを使用
use App\Models\Users; // Usersモデルを使用
use Validator;             // バリデーションを使用
use Auth;                  // 認証機能を使用

class MemosController extends Controller
{
    // 登録（ここから）
    public function store(Request $request){
        
        // バリデーション（ここから）
        $validator = Validator::make($request->all(), [
            'memo_content' => 'required | min:1 | max:99',
        ]);
        // バリデーション（ここまで）

        // バリデーションエラー時（ここから）
        if($validator->fails()) {
            return redirect('/main')
            ->withInput()
            ->withErrors($validator);
        }
        // バリデーションエラー時（ここまで）
    
        // 登録処理（ここから）
        $memos = new Memo;
        $memos->memo_content = $request->memo_content;
        $memos->save();
        return redirect('/main');
        // 登録処理（ここまで）

    }
    // 登録（ここまで）

    // 編集（ここから）
    // 編集（ここまで）

    // 削除（ここから）
    // 削除（ここまで）

    // 一覧表示（ここから）
    public function memosIndex()
    {
        $memos = Memo::orderBy('id','asc')
        ->paginate(20);
        return view('main',
        [
        'memos' => $memos
        ]);
    }
    // 一覧表示（ここまで）
}
