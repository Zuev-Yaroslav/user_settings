<?php

namespace App\Presentation\Http\Resources\Profile;

use App\Presentation\Http\Resources\User\UserResource;
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
            'gender_title' => $this->gender_title,
            'birthed_at' => Carbon::parse($this->birthed_at)->format('Y-m-d'),
//            'birthed_at' => $this->birthed_at,
            'about_me' => $this->about_me,
            'user' => UserResource::make($this->user)->resolve(),
            'created_at' => $this->created_at,
        ];
    }
}
