<?php

namespace Wosseb\Mailclient\Services;
use MailboxConnection;
use Wosseb\Mailclient\Repositories\Criteria\InboxId;
use Wosseb\Mailclient\Repositories\Criteria\NameNotIn;
use Wosseb\Mailclient\Repositories\MailboxRepository;
use Wosseb\Mailclient\Repositories\MessageRepository;

/**
 * Created by PhpStorm.
 * User: Luxite
 * Date: 2017-02-13
 * Time: 12:59
 */
class SyncMailService
{
    /**
     * @var MailboxConnection
     */
    private $connection;
    /**
     * @var MailboxRepository
     */
    private $mailboxRepository;
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * SyncMail constructor.
     * @param MailboxRepository $mailboxRepository
     * @param MessageRepository $messageRepository
     */
    public function __construct(
        MailboxRepository $mailboxRepository,
        MessageRepository $messageRepository
    )
    {
        $this->connection = resolve('MailboxConnection');
        $this->mailboxRepository = $mailboxRepository;
        $this->messageRepository = $messageRepository;
    }

    public function synchronizeFolders(){

        $mailboxes = collect($this->connection->getMailboxes())->map(function($item){
            return trim($item->getName());
        });

        $this->mailboxRepository->deleteOldMailboxes($mailboxes);

        $mailboxes->diff($this->mailboxRepository->all()->pluck('name'))
            ->map(function($item){
                $this->mailboxRepository->create(['name' => $item]);
            });
    }

    public function synchronizeMessages($id)
    {
        $mailboxName = $this->mailboxRepository->find($id)->name;

        $mailbox = $this->connection->getMailbox($mailboxName);

        $messages = collect($mailbox->getMessages())->map(function($item){
            return [ 'id' => $item->getId(), 'message' => $item ];
        });

        $this->messageRepository->deleteOldMessages($id, $messages);

        $currentMessages = $this->messageRepository->getByCriteria(new InboxId($id))->all()->pluck('message_id');

        $messages
            ->reject(function($value) use ($currentMessages) {
                return in_array($value['id'], $currentMessages->all());
            })
            ->map(function($item) use ($id) {
                $this->messageRepository->create([
                    'mailbox_id'    => $id,
                    'message_id'    => $item['message']->getId(),
                    'message_number'=> $item['message']->getNumber(),
                    'subject'       => $item['message']->getSubject(),
                    'body_html'     => $item['message']->getBodyHtml(),
                    'body_text'     => $item['message']->getBodyText(),
                    'from'          => $item['message']->getFrom(),
                    'to'            => $item['message']->getTo(),
                    'date'          => $item['message']->getDate()->format('Y-m-d H:i:s'),
                    'answered'      => $item['message']->isAnswered(),
                    'deleted'       => $item['message']->isDeleted(),
                    'seen'          => $item['message']->isSeen(),
                    'draft'         => $item['message']->isDraft(),
                ]);
            });
    }


}