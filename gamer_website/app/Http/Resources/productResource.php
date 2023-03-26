<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             'id'=>$this->id,
             'name'=>$this->name,
             'description'=>$this->description,
             'image'=>$this->image,
             'category'=> new categoryResource($this->category),
             'price'=>$this->price,
             'quantity'=>$this->quantity,
             'seller'=> new userResource($this->user),
        ];
    }

    public static $wrap = 'product(s)';
    
}
