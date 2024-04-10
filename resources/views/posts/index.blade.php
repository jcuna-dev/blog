{{-- resources/views/posts/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <table class="table" id="postsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <!-- Posts will be loaded here dynamically -->
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("posts.ajaxIndex") }}',
            type: 'GET',
            dataType: 'json',
            //FOR EDIT AND DELETE BUTTON
            success: function(data) {
                var rows = '';
                $.each(data, function(key, post) {
                    rows += '<tr>' +
                                '<td>' + post.id + '</td>' +
                                '<td>' + post.name + '</td>' +
                                '<td>' + post.content + '</td>' +
                                '<td>' +
                                    '<a href="/posts/' + post.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ' +
                                    '<button onclick="deletePost(' + post.id + ')" class="btn btn-sm btn-danger">Delete</button>' +
                                '</td>' +
                            '</tr>';
                });
                $("#postsTable tbody").html(rows);
            }
        });
    });
    //AJAX DELETE FUNCTIONALITY
    function deletePost(id) {
        if(confirm('Are you sure you want to delete this post?')) {
            $.ajax({
                url: '/posts/' + id,
                type: 'POST', // Using POST because browsers/form only support GET and POST
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    _method: 'DELETE', // Spoofing DELETE method
                },
                success: function(response) {
                    alert('Post deleted successfully');
                    // Optionally, refresh the posts list or remove the deleted post row
                    // $('#row-' + id).remove(); // If you add an ID to each row
                },
                error: function(xhr) {
                    // Handle error
                    alert('An error occurred');
                }
            });
        }
    }
</script>
@endpush

{{--FOR DATATABLE BASE ON DATATABLE.NET Add this at the end of your resources/views/posts/index.blade.php file --}}
@section('scripts')
    <script>
    $(document).ready( function () {
        $('#postsTable').DataTable();
    });
    </script>
@endsection