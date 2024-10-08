<?php

namespace App\Presentation\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
//            'email' => $this->email,
//            'profile' => ProfileResource::make($this->profile),
//            'created_at' => $this->created_at,
        ];
    }
}
