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

    // ユーザーごとに情報を区別するためのログイン認証コンストラクタ（ここから）
    public function __construct()
    {
        $this->middleware('auth');
    }
    // ユーザーごとに情報を区別するためのログイン認証コンストラクタ（ここまで）

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
        $memos->user_id      = Auth::user()->id;
        $memos->save();
        return redirect('/main');
        // 登録処理（ここまで）

    }
    // 登録（ここまで）

    // 編集画面の表示・edit（ここから）
    public function edit($memo_id)
    {
        // Userテーブルのidをmemo_idとして使用し、ルートパラメータとする
        $memos = Memo::where('id', Auth::user()->id)->find($memo_id);
        return view('memosedit', 
        ['memo' => $memos]);
    }
    // 編集画面の表示・edit（ここまで）

    // 編集機能・updateメソッド（ここから）
    public function update(Request $request)
    {
    // バリデーション（ここから）
    $validator = Validator::make($request->all(),
        [
            'memo_content' => 'required | min:1 | max:99',
        ]);
        // バリデーション（ここまで）
        
        // バリデーション:エラー時の動き（ここから）
        if ($validator->fails()) 
        {
            // エラー時に編集画面を再表示する
            $memo = Memo::where('user_id', Auth::user()->id)->find($request->id);
            return redirect('/memosedit/' . $memo->id)
                ->withInput()
                ->withErrors($validator);
        }
        // バリデーション:エラー時の動き（ここまで）
        
        // 編集処理（ここから）
        // idはログイン認証されている情報を使用して、memo_contentは上書きする
        $memos = Memo::where('user_id', Auth::user()->id)->find($request->id);
        $memos->memo_content = $request->memo_content;
        $memos->save();
        return redirect('/main');
        // 編集処理（ここまで）
    }
    // 編集機能・updateメソッド（ここまで）

    // 削除・destroyメソッド（ここから）
    public function destroy($id){
    $memos = Memo::where('id', $id)->where('user_id', Auth::user()->id);

    if($memos) {
        $memos->delete();
    return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);

    }
    // 削除・destroyメソッド（ここまで）

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
