<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\PostResource;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
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
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return Response
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
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'data'=>'done!',
            'status'=>'delete success user'
        ],204);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Post $post)
    {
        $like=new Like();
        $like->post_id=$post->id;
        $like->user_id=auth()->user()->id;
        $like->save();
        return response()->json([
            'data'=>'post liked',
            'status'=>'success'
        ],201);
    }
}
