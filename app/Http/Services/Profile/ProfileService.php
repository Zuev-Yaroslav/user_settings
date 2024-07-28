<?php

namespace App\Http\Services\Profile;



use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ProfileService
{
    public function index()
    {
        return Profile::all();
    }
    public function store(array $data)
    {
        return Profile::create($data);
    }
    public function update($profile, array $data)
    {
        $profile->update($data);
    }
    public function destroy(Profile $profile)
    {
        $profile->delete();

    }
    public function sendVerificationEdit(array $data)
    {
        $sendingVerification = 'App\SendingVerification\SendingVerificationWith' . ucfirst($data['send_method']);
        (new $sendingVerification($data['profile_id']))->process();
    }
    public function verifyToEdit(array $data)
    {
        $profileId = $data['profile_id'];
        $code = $data['code'];

        $originalCode = Cache::get('edit_profile_data_by_verification:' . $profileId);
        if ($originalCode === $code) {
            $token = Str::random(40);
            Cache::forget('edit_profile_data_by_verification:' . $profileId);
            Cache::put('edit_profile_data_token:' . $profileId, $token , 60*60*24);
            return $token;
        }
        return null;
    }
}
