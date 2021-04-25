@extends('layouts.app')

@section('content')
    <div class="card text-dark bg-light mb-3 mx-auto" style="max-width: 600px;">
        <div class="card-header">ホーム</div>
        <div class="card-body">
            <form action="" method="POST">
                <input type="text" class="form-control mb-3" name="body" min="1" max="255" placeholder="今どうしてる？">
                <input type="submit" class="btn btn-secondary ms-auto" name="tweet" value="つぶやく">
            </form>
        </div>
    </div>
        @foreach ($posts as $post)
        <div class="card text-dark bg-light mb-3 mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p>{{ $post->user_name }}</p>
                    <p>{{ $post->created_at }}</p>
                </div>
                <p>{{ $post->body }}</p>
            </div>
        </div>
        @endforeach
@endsection
