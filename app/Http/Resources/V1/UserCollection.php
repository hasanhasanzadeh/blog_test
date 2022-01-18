<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
                    'id'=>$item->id,
                    'name'=>$item->name,
                    'email'=>$item->email,
                    'access_level'=>$item->access_level,
                    'commentsCount'=>count($item->comments),
                    'comments'=>$item->comments,
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
