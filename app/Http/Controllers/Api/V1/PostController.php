<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostCollection
     */
    public function index()
    {
        $posts=Post::paginate(10);
        return new PostCollection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post=new Post();
        $post->title=$request->title;
        $post->description=$request->description;
        $post->slug=$request->slug;
        $post->photo_url=$request->photo_url;
        $post->category_id=$request->category_id;
        $post->user_id=auth()->user()->id;
        $post->save();
        return response()->json([
            'data'=>new PostResource($post),
            'status'=>'success'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->title=$request->title;
        $post->description=$request->description;
        $post->slug=$request->slug;
        $post->photo_url=$request->photo_url;
        $post->user_id=auth()->user()->id;
        $post->save();
        return response()->json([
            'data'=>new PostResource($post),
            'status'=>'success'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id)->delete();
        return response()->json([
            'data'=>'done!',
            'status'=>'delete success user'
        ],204);
    }
}
