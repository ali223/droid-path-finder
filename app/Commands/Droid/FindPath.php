<?php

namespace App\Commands\Droid;

use App\Services\DroidPathFinder;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class FindPath extends Command
{
    protected $signature = 'droid:find-path';

    protected $description = 'Find the droid\'s path to the destination';

    public function handle(DroidPathFinder $droidPathFinder)
    {
        foreach ($droidPathFinder->navigatePath() as $pathStatus) {
            $this->info($pathStatus);
        }

        $this->info('*********************************');
        $this->info('Droid Path');
        $this->info('*********************************');
        $this->info($droidPathFinder->getPath());
    }
}
