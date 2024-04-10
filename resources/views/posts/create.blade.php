{{-- resources/views/posts/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Post</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/posts" id="postForm">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Post Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Post</button>
    </form>
</div>
@endsection

{{-- AJAX INSERTING DATA --}}
@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $('#postForm').submit(function(e) {
            e.preventDefault();
    
            var formData = {
                name: $('#name').val(),
                content: $('#content').val(),
            };
    
            $.ajax({
                type: 'POST',
                url: '{{ route("posts.ajaxStore") }}',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    alert(data.success);
                    // Clear the form fields
                    $('#postForm')[0].reset();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endpush