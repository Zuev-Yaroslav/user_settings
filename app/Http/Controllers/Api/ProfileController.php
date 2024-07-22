<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\SendCodeRequest;
use App\Http\Requests\Profile\StoreRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Requests\Profile\VerifyToEditRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Services\Profile\ProfileService;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProfileService $service)
    {
        return $service->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, ProfileService $service)
    {
        $data = $request->validated();

        $profile = $service->store($data);

        return ProfileResource::make($profile)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile, ProfileService $service)
    {
        return $service->show($profile);
    }
    public function sendVerificationEdit(SendCodeRequest $request, Profile $profile, ProfileService $service)
    {
        $data = $request->validated();

        $service->sendVerificationEdit($data);

        return response()->json([], Response::HTTP_OK);
    }
    public function verifyToEdit(VerifyToEditRequest $request, Profile $profile, ProfileService $service)
    {
        $data = $request->validated();

        $token = $service->verifyToEdit($data);

        if ($token) {
            return response()->json([], Response::HTTP_OK)->cookie(cookie('edit_profile_token', $token, 60*24));
        }
        return response()->json(['message' => 'Incorrect or expired'], Response::HTTP_UNAUTHORIZED);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Profile $profile, ProfileService $service)
    {
        $data = $request->validated();

        $service->update($profile, $data);

        return ProfileResource::make($profile)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile, ProfileService $service)
    {
        $service->destroy($profile);
        return response([], Response::HTTP_NO_CONTENT);
    }
}
