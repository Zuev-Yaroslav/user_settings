<?php

namespace App\SendingVerification;

use App\Mail\VerificationMail;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SendingVerificationWithTelegram extends SendingVerification
{

    protected function send()
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln('Code from telegram: ' . $this->code);
    }
}
