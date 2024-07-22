<?php

namespace App\Http\Resources\Profile;

use App\Http\Resources\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'third_name' => $this->third_name,
            'gender' => $this->gender,
            'gender_title' => $this->getGender(),
//            'birthed_at' => Carbon::parse($this->birthed_at)->format('d.m.Y'),
            'birthed_at' => $this->birthed_at,
            'about_me' => $this->about_me,
            'user' => UserResource::make($this->user)->resolve(),
            'created_at' => $this->created_at,
        ];
    }
}
