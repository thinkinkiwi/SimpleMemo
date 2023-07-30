@extends('layouts.app')
@section('content')

<!-- コンテンツ大枠（ここから） -->
<div class="row container">
    <div class="col-md-6">

        <!-- メモ編集フォーム（ここから） -->
        <form action="{{ url('memos/update') }}" 
        method="POST"
        class="form-horizontal">
        @csrf

        <!-- メモ編集画面（ここから） -->
        <div>
        No {{ $memo->id }} メモ編集
        <input type="text" name="memo_content" class="form-control" value="{{$memo->memo_content}}">
        </div>
        <!-- メモ編集画面（ここまで） -->

        <!-- 更新・戻るボタン（ここから） -->
        <div class="well well-sm">
            <!-- 戻るボタン -->
            <a href="{{ url('/main') }}">
            <button type="button"  class="btn btn-primary">
                戻る
            </button>
            
            <!-- 修正ボタン -->
            <button type="submit" class="btn btn-success">
                修正
            </button>
            </a>
        </div>
        <!--戻る・修正ボタン（ここまで） -->


        <!-- id値を送信 -->
        <input type="hidden" name="id" value="{{$memo->id}}">
        <!--/ id値を送信 -->
        
        </form>
        <!-- メモ編集フォーム（ここまで） -->

    </div>
</div>
<!-- コンテンツ大枠（ここまで） -->
@endsection