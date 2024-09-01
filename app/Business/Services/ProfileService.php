<?php

namespace App\Business\Services;



use App\Business\SendingVerification\UpdateProfile\SendVerificationFactory;
use App\Exceptions\ProfileException;
use App\Persistence\Models\Profile;
use App\Persistence\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProfileService
{
    public static function index() : Collection
    {
        return Profile::all();
    }
    public static function store(array $data) : Profile
    {
        $user = User::create($data['user']);
        $profile = $user->profile()->create($data['profile']);
        return $profile;
    }
    public static function update($profile, array $data)
    {
        $profile->update($data);
    }
    public static function destroy(Profile $profile)
    {
        $profile->delete();
        $profile->user()->delete();
    }
    public static function sendVerificationNotification(array $data, Profile $profile) : void
    {
        SendVerificationFactory::make($data['send_method'], $profile)->process();
    }
    public static function verify(array $data, Profile $profile) : string
    {
        $originalCode = Cache::get('verification:code:update_profile:' . $profile->id);
        ProfileException::checkIfIncorrectVerificationCode($originalCode !== $data['code']);

        $token = bin2hex(random_bytes(32));
        Cache::forget('verification:code:update_profile:' . $profile->id);
        Cache::put('token:update_profile:' . $profile->id, $token , now()->addDay());
        return $token;
    }
}
