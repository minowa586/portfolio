<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'exercise')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // 投稿詳細
    public function show(Post $post)
    {
        $post->load(['user', 'exercise', 'comments.user']); // ← ここがポイント！
    
        return view('posts.show', compact('post'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post){
        $input = $request['post'];
        $input['user_id'] = Auth::id();
        $post->fill($input)->save();

        return redirect('/posts/');
    }


// 投稿編集フォーム表示
public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

// 投稿の更新処理
public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'exercise_id' => 'required|exists:exercises,id',
    ]);

    $post->update($validated);

    return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
}

// 投稿の削除処理
public function destroy(Post $post)
{
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted!');
}

}
