<?php

namespace App\Http\Resources;

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
//        return parent::toArray($request);
       return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'DATE' => $this->birthdate,
            'IMAGE' => $this->image,
            'Gender' => $this->gender,
            'notify' => $this->notify,
//            'Role' => $this->roles->type, ////Note Call role type
 //            'pass' => $this->password,
            'Google' => $this->google_id,
            'facebook' => $this->facebook_id,
            'twitter' => $this->twitter_id,
            'OAuth' => $this->oauth_type,
             'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,



           ];

    }
}
