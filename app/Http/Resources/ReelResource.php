<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReelResource extends JsonResource
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
            'NAME' => $this->name,
            'User' => $this->caption,
            'VIDEO' => $this->video_url,
            'LIKES' => $this->likes_count,
            'COMMENTS' => $this->comments_count,
             'Date' => $this->created_at,

        ];
    }
}
