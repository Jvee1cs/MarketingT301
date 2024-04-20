<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;
use Carbon\Carbon;

class DeleteExpiredLinks extends Command
{
    protected $signature = 'links:delete-expired';

    protected $description = 'Delete expired links from the database';

    public function handle()
    {
        // Delete links where the expiration time has passed
        Link::where('expires_at', '<', Carbon::now())->delete();

        $this->info('Expired links have been deleted successfully.');
    }
}
