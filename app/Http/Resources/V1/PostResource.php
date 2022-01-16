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
                'title'=>$this->title,
                'body'=>$this->description,
                'Author'=>$this->user->name,
                'categoryName'=>$this->category->name,
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
