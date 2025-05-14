<!-- resources/views/posts/create.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿作成</title>
</head>
<body>
    <h1>筋トレの記録を投稿！</h1>
    @if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>　　　//CSRFトークンと成功メッセージの表示
    @endif
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">タイトル:</label>
            <input type="text" name="post[title]" id="title">
        </div>
        <div>
            <label for="description">内容:</label>
            <textarea name="post[description]" id="description"></textarea>
        </div>
        <input type="hidden" name="post[exercise_id]" value="1">
        <button type="submit">投稿する</button>
    </form>
</body>
</html>
