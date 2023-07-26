@extends('layouts.app')
@section('content')

<!-- コンテンツ大枠（ここから） -->
<div class="card-body">
    <div class="card-title">
        新規登録
    </div>

    <!-- 新規メモ追加フォーム（ここから） -->
    <form action="{{ url('memos') }}" 
     method="POST"
     class="form-horizontal">
     @csrf

     <!-- メモ内容（ここから） -->
     <div class="form-group">
        <div class="col-sm-6">
            <input type="text" name="memo_content"></input>
        </div>
     </div>
     <!-- メモ内容（ここまで） -->

     <!-- メモ登録ボタン（ここから） -->
     <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">
                登録
            </button>
        </div>
     </div>
     <!-- メモ登録ボタン（ここまで） -->
    </form>
    <!-- 新規メモ追加フォーム（ここまで） -->



</div>
<!-- コンテンツ大枠（ここから） -->

@endsection