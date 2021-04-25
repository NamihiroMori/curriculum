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
