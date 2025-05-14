<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
{
    $request->validate([
        'description' => 'required|string|max:1000',
    ]);

    $post->comments()->create([
        'user_id' => auth()->id(),
        'description' => $request->input('description'),
    ]);

    return redirect()->back()->with('success', 'コメントを投稿しました！');
}
    // 編集画面を表示
public function edit(Comment $comment)
{
    // 本人か確認（セキュリティ）
    if ($comment->user_id !== auth()->id()) {
        abort(403);
    }

    return view('comments.edit', compact('comment'));
}

// コメントを更新
public function update(Request $request, Comment $comment)
{
    if ($comment->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $comment->update([
        'body' => $request->input('body'),
    ]);

    return redirect()->route('posts.show', $comment->post_id)->with('success', 'コメントを更新しました！');
}

// コメントを削除
public function destroy(Comment $comment)
{
    if ($comment->user_id !== auth()->id()) {
        abort(403);
    }

    $comment->delete();

    return redirect()->back()->with('success', 'コメントを削除しました！');
}

}
