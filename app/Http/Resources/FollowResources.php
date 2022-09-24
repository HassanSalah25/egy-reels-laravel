<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowResources extends JsonResource
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
            'user_id' => $this->user_id,
            'fuser_id' => $this->fuser_id,
            'Date' => $this->created_at,

    ];

    }
}
