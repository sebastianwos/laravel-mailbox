<?php

namespace Wosseb\Mailclient\Commands;

use Illuminate\Console\Command;
use Wosseb\Mailclient\Http\Jobs\SyncFoldersJob;
use Wosseb\Mailclient\Http\Jobs\SyncMessagesJob;
use Wosseb\Mailclient\Repositories\MailboxRepository;
use Wosseb\Mailclient\Services\SyncMailService;

class SynchronizeMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:mailboxes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize mailboxes for Mailclient';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param MailboxRepository $mailboxRepository
     * @return mixed
     */
    public function handle(MailboxRepository $mailboxRepository)
    {
        dispatch(new SyncFoldersJob());
        foreach($mailboxRepository->all() as $mailbox){
            dispatch(new SyncMessagesJob($mailbox->id));
        }
    }
}
