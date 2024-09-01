<?php

namespace App\Business\SendingVerification\UpdateProfile;

use App\Business\LogChannels\LogChannel;

class SendVerificationViaEmail extends SendVerification
{

    protected function send(): void
    {
        LogChannel::build('verification-codes')->info('Code from email: ' . $this->code);
    }
}
