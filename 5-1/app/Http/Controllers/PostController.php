<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * ツイート一覧の取得
     * 
     */
    public function index(Request $request)
    {

        // postsテーブルから全レコードを取得
        $posts = Post::all();

        // user_idに対応するレコードをuser1テーブルから取得し、name属性を$postsのuser_nameとして設定する
        for ($i = 0; $i < $posts->count(); $i++) {
            $user = User::find($posts[$i]->user_id);
            $posts[$i]['user_name'] = $user['name'];
        }

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * 新規ツイートの保存
     * 
     * 
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->body = $request->body;

        // リクエストのセッション名からuserテーブルのidを検索
        $user = User::where('name', Auth::user()->name)->first();
        $post->user_id = $user->id;

        $post->save();

        return redirect('/index');
    }
}
