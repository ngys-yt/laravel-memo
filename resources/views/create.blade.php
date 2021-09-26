@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">新規メモ作成</div>
        {{-- POSTで入力されたtextを投げる --}}
        {{-- route('store')と書くと/storeに変換してくれる --}}
        <form class="card-body my-card-body" action="{{ route('store') }}" method="POST">
            {{-- セキリュティ --}}
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="content" rows="3" placeholder="ここにメモを入力"></textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">メモ内容を入力してください！</div>
            @enderror
        @foreach ($tags as $t)
            <div class="form-check form-check-inline mb-3">
                <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $t['id'] }}" value="{{ $t['id'] }}">
                {{-- label⇨チェックボックスじゃなく文字をクリックしてもチェックが入る --}}
                <label class="form-check-label" for="{{ $t['id'] }}">{{ $t['name'] }}</label>
            </div>
        @endforeach
            {{-- w-50⇨幅５０％  mb-3⇨margin-bottom 1rem(親の文字サイズ分) --}}
            <input type="text" class="form-control w-50 mb-3" name="new_tag" placeholder="新しいタグを入力" />
            {{-- type=submit にすることでaction=store に飛ぶ --}}
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
@endsection
