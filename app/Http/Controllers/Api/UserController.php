<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserService $service)
    {
        return $service->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, UserService $service)
    {
        $data = $request->validated();

        $user = $service->store($data);

        return UserResource::make($user)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, UserService $service)
    {
        return $service->show($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user, UserService $service)
    {
        $data = $request->validated();

        $user = $service->update($user, $data);

        return UserResource::make($user)->resolve();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, UserService $service)
    {
        return $service->destroy($user);
    }
}
