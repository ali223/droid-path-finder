<?php

namespace App\Commands\Droid;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class FindPath extends Command
{
    protected $signature = 'droid:find-path';

    protected $description = 'Find the droid\'s path to the destination';

    public function handle()
    {
        $this->info('test path');
    }
}
