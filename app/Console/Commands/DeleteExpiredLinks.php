<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;
use Carbon\Carbon;

class DeleteExpiredLinks extends Command
{
    protected $signature = 'links:delete-expired';

    protected $description = 'Delete expired links';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $expiredLinks = Link::where('expires_at', '<=', Carbon::now())->get();

        foreach ($expiredLinks as $link) {
            $link->delete();
            $this->info("Link {$link->unique_identifier} deleted because it has expired.");
        }
    }
}
