<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{
    // Use __constructor to build proper middleware
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('viewAny', Auth::user())){ // If not admin, this throws 403 error. The way to implementation this function should be reconstruct.
            // return redirect()->route('user.index'); // You fall into an infinite loop.
            return view('post.index')->withPosts(Post::all()->sortByDesc('id'));
        }else if ($this->authorize('view', Auth::user())){
            return view('post.index')->withPosts(Post::find(Auth::id())->sortByDesc('id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post([
            'author_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        if ($this->authorize('create', $post)){
            $post->save();
        }

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($this->authorize('view', $post)){
            return view('post.edit')->withPost($post);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($this->authorize('update', $post)){
            $post['title'] = $request->input('title');
            $post['content'] = $request->input('content');
            $post->save();
        }

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($this->authorize('delete', $post)){
            $post->delete();
        }
        return redirect()->route('post.index');
    }
}
