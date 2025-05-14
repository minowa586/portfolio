@extends('layouts.app')

@section('content')
<h1>Edit Comment</h1>

<form action="{{ route('comments.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <textarea name="body" rows="4" required>{{ old('body', $comment->body) }}</textarea><br>
    <button type="submit">Update</button>
</form>
@endsection
