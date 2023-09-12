<?php

namespace App\Console\Commands;

use App\Models\Distribution;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DistributionUpdateStatusCommand extends Command
{
    protected $signature = 'distribution:update-status';

    protected $description = 'Command description';

    public function handle(): void
    {
        $count = Distribution::where('status', 'pending')->where('created_at', '<', now()->subMinutes(3))->update(['status' => 'error']);
        Log::info('UPDATE_DISTRIBUTION_STATUS: ' . $count);
    }
}
