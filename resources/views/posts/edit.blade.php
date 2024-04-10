{{-- resources/views/posts/edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    <form method="POST" action="/posts/{{ $post->id }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name">Post Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection