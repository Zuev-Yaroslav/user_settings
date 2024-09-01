<?php

namespace App\Business\SendingVerification\UpdateProfile;

use App\Persistence\Models\Profile;

class SendVerificationFactory
{
    // Factory method
    public static function make(string $sendingMethod, Profile $profile) : SendVerification
    {
        $classTitle = __NAMESPACE__ . "\\SendVerificationVia" . ucfirst(strtolower($sendingMethod));
        if (class_exists($classTitle)) {
            return new $classTitle($profile);
        }
        return new NullSendVerification($profile);
    }
}
