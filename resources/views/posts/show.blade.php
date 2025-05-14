<x-app-layout>
   <h1>{{ $post->title }}</h1>

    <p><strong>Date:</strong> {{ $post->date }}</p>
    <p><strong>Exercise:</strong> {{ $post->exercise->name ?? 'N/A' }}</p>
    <p><strong>Posted by:</strong> {{ $post->user->name }}</p>

    <hr>

    <h3>Memo</h3>
    <p>{{ $post->description }}</p>

    <hr>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- コメント投稿フォーム --}}
    <h3>Leave a comment</h3>
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <textarea name="body" rows="3" required placeholder="Write a comment..."></textarea><br>
        <button type="submit">Post Comment</button>
    </form>

    <hr>

    {{-- コメント一覧 --}}
    <h3>Comments</h3>
    @forelse ($post->comments as $comment)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <strong>{{ $comment->user->name }}</strong><br>
            {{ $comment->body }}<br>
            <small>Posted on {{ $comment->created_at->format('Y-m-d H:i') }}</small>

            @if (Auth::id() === $comment->user_id)
    <a href="{{ route('comments.edit', $comment->id) }}">Edit</a>

    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    @endif
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse
 </x-app-layout>