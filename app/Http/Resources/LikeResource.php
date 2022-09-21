<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'ID' => $this->id,
            'Reel' => $this->reel_id,
            'User' => $this->user_id,
            'Active' => $this->active,
            'Date' => $this->created_at,

        ];
    }
}
