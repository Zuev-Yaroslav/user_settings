<?php

namespace App\Business\SendingVerification\UpdateProfile;

use App\Business\LogChannels\LogChannel;

class SendVerificationViaTelegram extends SendVerification
{

    protected function send(): void
    {
        LogChannel::build('verification-codes')->info('Code from telegram: ' . $this->code);
    }
}
