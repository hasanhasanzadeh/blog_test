<?php

namespace App\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'data'=>$this->collection->map(function ($item){
             return [
                'id'=>$item->id,
                'title'=>$item->title,
                'slug'=>$item->slug,
                'body'=>$item->description,
                'imageUrl'=>$item->photo_url,
                 'categoryName'=>$item->category->name,
                'Author'=>$item->user->name,
                 'commentCount'=>count($item->comments),
                 'comments'=>$item->comments,
                 'likeCount'=>count($item->likes),
                'createdTim'=>(string) $item->created_at
             ] ;
          })
        ];
    }

    public function with($request): array
    {
        return [
            'status'=>'success'
        ];
    }
}
