<?php

namespace Wosseb\Mailclient\Http\ViewComposers;

use Wosseb\Mailclient\Repositories\MailboxRepository;
use Illuminate\View\View;

/**
 * Created by PhpStorm.
 * User: Luxite
 * Date: 2017-02-16
 * Time: 09:32
 */
class FoldersComposer
{
    /**
     * @var MailboxRepository
     */
    private $mailbox;

    /**
     * Create a new profile composer.
     *
     * @param MailboxRepository $mailbox
     */
    public function __construct(MailboxRepository $mailbox)
    {
        $this->mailbox = $mailbox;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('mailboxes', $this->mailbox->all());
    }
}