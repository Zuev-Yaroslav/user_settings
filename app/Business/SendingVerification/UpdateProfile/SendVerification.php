<?php

namespace App\Business\SendingVerification\UpdateProfile;

use App\Persistence\Models\Profile;
use Illuminate\Support\Facades\Cache;

// prototype
abstract class SendVerification
{
    protected string $key = 'verification:code:update_profile:';
    protected string $code;
    protected Profile $profile;

    public function __construct(Profile $profile)
    {
        $this->key .= $profile->id;
        $this->profile = $profile;
    }

    private function setCode()
    {
        $this->code = random_int(100000, 999999);
    }
    private function setCodeToCache()
    {
        Cache::put($this->key, $this->code, now()->addMinutes(10));
    }
    abstract protected function send() : void;

    public function process() : void
    {
        $this->setCode();
        $this->send();
        $this->setCodeToCache();
    }
}
