<?php

namespace App\Business\LogChannels;

use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

class LogChannel
{
    public static function build(string $name) : LoggerInterface
    {
        return Log::build([
            'driver' => 'single',
            'path' => storage_path("logs/{$name}.log"),
        ]);
    }
}
