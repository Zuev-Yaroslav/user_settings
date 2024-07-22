<?php

namespace App\Http\Services\User;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function index()
    {
        return UserResource::collection(User::all())->resolve();
    }
    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
    public function show(User $user)
    {
        return UserResource::make($user)->resolve();
    }
    public function update($user, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $user->update($data);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response([], Response::HTTP_NO_CONTENT);
    }
}
