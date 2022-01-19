<?php

namespace App\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                'name'=>$item->name,
                'slug'=>$item->slug,
                'parentId'=>$item->parent_id,
                  'createdTime'=>(string) $item->created_at
              ];
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
