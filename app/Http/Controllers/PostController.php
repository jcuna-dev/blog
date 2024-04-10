<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Post::all();
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = new \App\Post;
        $post->name = $request->name;
        $post->content = $request->content;
        $post->save();

        return redirect('/posts/create')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = \App\Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = \App\Post::findOrFail($id);
        $post->name = $request->name;
        $post->content = $request->content;
        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfully.');
    }
    public function destroy($id)
    {
        $post = \App\Post::findOrFail($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted successfully.');
    }


    //AJAX INSERTING DATA
    public function ajaxStore(Request $request)
    {
        $post = new \App\Post();
        $post->name = $request->name;
        $post->content = $request->content;
        $post->save();

        return response()->json(['success' => 'Post added successfully.']);
    }
    //AJAX VIEWING THE DATA
    public function ajaxIndex()
    {
        $posts = \App\Post::all();
        return response()->json($posts);
    }
}
