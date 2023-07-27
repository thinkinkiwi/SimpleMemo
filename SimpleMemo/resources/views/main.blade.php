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

    <!-- メモ一覧表示（ここから）｜0でなければ表示 -->
    @if($memos->count() > 0)
    <div class="card-body">
    
        <!-- メモ一覧内容（ここから） -->
        <table class="table">
            
        <!-- メモヘッダ（ここから） -->
        <thead>
            <tr>
                <th></th>
                <th>メモ一覧</th>
            </tr>
            <tr>
                <th>No</th>
                <th>メモ内容</th>
                <th>作成日時</th>
                <th>編集日時</th>
            </tr>
        </thead>
        <!-- メモヘッダ（ここまで） -->

        <!-- メモコンテンツ（ここから） -->
        <tbody>
            @foreach($memos as $memo)
            <tr>
                <td>{{ $memo->id }}</td>
                <td>{{ $memo->memo_content }}</td>
                <td>{{ $memo->created_at }}</td>
                <td>{{ $memo->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
        <!-- メモコンテンツ（ここまで） -->
    
    </table>
    <!-- メモ一覧内容（ここまで） -->

</div>
@endif
<!-- メモ一覧表示（ここまで） -->


</div>
<!-- コンテンツ大枠（ここから） -->

@endsection