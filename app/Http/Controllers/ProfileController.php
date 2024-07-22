<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Services\Profile\ProfileService;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProfileService $service)
    {
        $profiles = $service->index();
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
    public function show(Profile $profile, ProfileService $service)
    {
        $profile = $service->show($profile);
        return inertia('Profile/Show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile, ProfileService $service)
    {
        $profile = $service->show($profile);
        return inertia('Profile/Edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Profile $profile, ProfileService $service)
    {
        $data = $request->validated();
        $service->update($profile, $data);
        return redirect()->route('profile.show', $profile->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {

    }
}
