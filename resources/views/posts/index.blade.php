<x-app-layout>
    <h1>投稿一覧</h1>
    <a href="/posts/create">新規作成</a>
    @foreach ($posts as $post)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h2>
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            </h2>
            <p>投稿日: {{ $post->created_at}}</p>
            <p>種目: {{ $post->exercise->name ?? '不明' }}</p>
            <p>投稿者: {{ $post->user->name }}</p>
        </div>
    @endforeach
</x-app-layout>wwww