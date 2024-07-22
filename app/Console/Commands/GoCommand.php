<?php

namespace App\Console\Commands;

use App\SendingVerification\SendingVerificationWithEmail;
use Illuminate\Console\Command;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $user = User::first();
//        $profile = Profile::first();
//        dd($profile->user);
        (new SendingVerificationWithEmail(6))->process();
//        Cache::put('example', '1111');
    }
}
