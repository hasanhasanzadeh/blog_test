<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'data'=>$this->collection->map(function ($item){
             return [
                'title'=>$item->title,
                'slug'=>$item->slug,
                'body'=>$item->description,
                'imageUrl'=>$item->photo_url,
                 'categoryName'=>$item->category->name,
                'Author'=>$item->user->name,
                 'commentCount'=>count($item->comments),
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
