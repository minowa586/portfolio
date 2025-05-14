@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>

        <div>
            <label>Body</label>
            <textarea name="body" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div>
            <label>Exercise</label>
            <select name="exercise_id">
                @foreach(\App\Models\Exercise::all() as $exercise)
                    <option value="{{ $exercise->id }}" {{ $post->exercise_id == $exercise->id ? 'selected' : '' }}>
                        {{ $exercise->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('posts.edit', $post) }}">Edit</a>

<form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>


        <button type="submit">Update</button>
    </form>
</div>
@endsection
