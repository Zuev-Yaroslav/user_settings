<?php

namespace App\Presentation\Http\Controllers;

use App\Business\Services\ProfileService;
use App\Persistence\Models\Profile;
use App\Presentation\Http\Requests\Profile\SendVerificationRequest;
use App\Presentation\Http\Requests\Profile\UpdateRequest;
use App\Presentation\Http\Requests\Profile\VerifyRequest;
use App\Presentation\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = ProfileResource::collection(ProfileService::index())->resolve();
        return inertia('Profile/Index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();
        return inertia('Profile/Show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();
        return inertia('Profile/Edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Profile $profile)
    {
        $data = $request->validated();
        ProfileService::update($profile, $data);
        return ($request->wantsJson())
            ? response()->json(ProfileResource::make($profile)->resolve())->withoutCookie('profile_update_token')
            : redirect()->route('profiles.show', $profile->id)->withoutCookie('profile_update_token');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {

    }
    public function showVerificationSending(Profile $profile)
    {
        $profile = ProfileResource::make($profile)->resolve();
        return inertia('Profile/ShowVerificationSending', compact('profile'));
    }
    public function sendVerificationNotification(SendVerificationRequest $request, Profile $profile)
    {
        $data = $request->validated();

        ProfileService::sendVerificationNotification($data, $profile);

        return response()->json();
    }
    public function verify(VerifyRequest $request, Profile $profile)
    {
        $data = $request->validated();

        $token = ProfileService::verify($data, $profile);

        return response()->json()
            ->cookie(cookie('profile_update_token', $token, 60*24));
    }
}
