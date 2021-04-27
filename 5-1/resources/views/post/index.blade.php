@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card text-dark bg-light mb-3 mx-auto" style="max-width: 600px;">
        <div class="card-header">ホーム</div>
        <div class="card-body">
            <form action="{{ action('PostController@store') }}" method="POST">
                @csrf
                <input type="text" class="form-control mb-3" name="body" min="1" max="255" placeholder="今どうしてる？">
                <div class="d-flex justify-content-end">
                    <input type="submit" class="btn btn-secondary" name="tweet" value="つぶやく">
                </div>
            </form>
        </div>
    </div>
    @foreach ($posts as $post)
        <div class="card text-dark bg-light mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="font-weight-bold">{{ $post->user_name }}</p>
                    <p>{{ $post->created_at }}</p>
                </div>
                <div class="row">
                    <p class="col-md-10">{{ $post->body }}</p>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        {{-- 削除ボタン：ログインユーザーと同じユーザーの投稿の場合のみ表示 --}}
                        @if ($post->user_name === Auth::user()->name)
                            <a class="text-danger" href="{{ action('PostController@delete', ['id' => $post->id]) }}">削除</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
