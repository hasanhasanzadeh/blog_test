<?php

namespace App\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=>[
                'id'=>$this->id,
                'title'=>$this->title,
                'slug'=>$this->slug,
                'body'=>$this->description,
                'Author'=>$this->user->name,
                'categoryName'=>$this->category->name,
                'commentCount'=>count($this->comments),
                'comments'=>$this->comments,
                'likeCount'=>count($this->likes),
                'createdTime'=>(string) $this->created_at
                ]
        ];
    }

    public function with($request): array
    {
        return [
            'status'=>'success'
        ];
    }
}
