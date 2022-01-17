<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
          'name'=>$this->name,
          'email'=>$this->email,
          'remember_token'=>$this->remember_token,
          'api_token'=>$this->api_token,
          'access_level'=>$this->access_level
        ];
    }
}