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

        <!-- メモ登録窓、登録ボタン（ここから） -->
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="memo_content"></input>
                <button type="submit" class="btn btn-primary">
                    登録
                </button>

                <!-- バリデーション時、エラーメッセージを表示する（ここから） -->
                @error('memo_content')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
                <!-- バリデーション時、エラーメッセージを表示する（ここまで） -->

            </div>
        </div>
        <!-- メモ登録窓、登録ボタン（ここまで） -->

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
                <td>
                    <a href="{{ url('memosedit/'.$memo->id) }}" class="btn btn-success">編集</a>
                    <button class="btn btn-danger" onclick="memosDelete({{ $memo->id }})">削除</button>
                </td>
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
<!-- コンテンツ大枠（ここまで） -->
@endsection

<!-- 削除確認ウィンドウを表示するJS（ここから） -->
<script>
    function memosDelete(memo_id) {
        // 確認ウィンドウを表示
        if (confirm('本当に削除してもよろしいですか？')) {
            // OK→削除実行（destroy）
            $.ajax({
                url: `{{ url('memos') }}/${memo_id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function (data) {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('削除に失敗しました');
                    }
                },
                error: function () {
                    alert('エラーが発生しました');
                }
            });
        }
    }
</script>
<!-- 削除確認ウィンドウを表示するJS（ここまで） -->