<?php

namespace App\SendingVerification;

use App\Mail\VerificationMail;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SendingVerificationWithEmail extends SendingVerification
{

    protected function send()
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln('Code from email: ' . $this->code);
//        $profile = Profile::findOrFail($this->profileId);
//        Mail::to($profile->user->email)->send(new VerificationMail($this->code));
    }
}
