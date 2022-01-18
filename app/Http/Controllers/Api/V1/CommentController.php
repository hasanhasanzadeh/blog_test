<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment=new Comment();
        $comment->user_id=auth()->user()->id;
        $comment->parent_id=$request->parent_id;
        $comment->commentable_id=$request->id;
        $comment->commentable_type=$request->type=='post' ? 'App\Models\Post':'App\Models\User';
        $comment->body=$request->body;
        $comment->save();
        return response()->json([
            'data'=>'comment is stored!',
            'status'=>'success'
        ],200);
    }


}
