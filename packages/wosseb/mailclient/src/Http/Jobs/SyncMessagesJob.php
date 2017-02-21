<?php

namespace Wosseb\Mailclient\Http\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Wosseb\Mailclient\Services\SyncMailService;

class SyncMessagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    public $folder;

    /**
     * Create a new job instance.
     *
     * @param $folder
     */
    public function __construct($folder)
    {
        $this->folder = $folder;
    }

    /**
     * Execute the job.
     *
     * @param SyncMailService $syncService
     */
    public function handle(SyncMailService $syncService)
    {
        $syncService->synchronizeMessages($this->folder);
    }
}
