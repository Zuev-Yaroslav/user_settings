<?php

namespace App\SendingVerification;

use App\Models\Profile;
use Illuminate\Support\Facades\Cache;

abstract class SendingVerification
{
    protected string $key = 'edit_profile_data_by_verification:';
    protected int $code;
    protected int $profileId;

    /**
     * @param int $profileId
     */
    public function __construct(int $profileId)
    {
        $this->key .= $profileId;
        $this->profileId = $profileId;
    }
    protected function setCode()
    {
        $this->code = random_int(100000, 999999);
    }
    protected function setCodeToCache()
    {
        Cache::put($this->key, $this->code, 60*10);
    }
    abstract protected function send();

    public function process()
    {
        $this->setCode();
        $this->send();
        $this->setCodeToCache();
    }
}
