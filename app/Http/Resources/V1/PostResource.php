<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
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
