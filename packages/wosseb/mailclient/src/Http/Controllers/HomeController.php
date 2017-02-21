<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace Wosseb\Mailclient\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Wosseb\Mailclient\Repositories\Criteria\InboxId;
use Wosseb\Mailclient\Repositories\Criteria\NameNotIn;
use Wosseb\Mailclient\Repositories\MailboxRepository;
use Wosseb\Mailclient\Repositories\MessageRepository;
use Wosseb\Mailclient\Services\SyncMailService;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * Create a new controller instance.
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->middleware('auth');
        $this->messageRepository = $messageRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param MailboxRepository $mailboxRepository
     * @return Response
     */
    public function index(MailboxRepository $mailboxRepository)
    {
        $inbox = $mailboxRepository->findBy('name', 'INBOX');
        $messages = $this->messageRepository->getByCriteria(new InboxId($inbox->id))->paginate(10);
        return view('mailclient::listmessages', compact('messages'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMessages($id)
    {
        $messages = $this->messageRepository->getByCriteria(new InboxId($id))->paginate(10);
        return view('mailclient::listmessages', compact('messages'));
    }

    /**
     * @param $mailbox
     * @param $message
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMessage($mailbox, $message)
    {
        $connection = resolve('MailboxConnection');
        $message = $this->messageRepository->with(['mailbox'])->findWhere(['mailbox_id' => $mailbox, 'message_number' => $message])->first();

        $IMAPmailbox = $connection->getMailbox($message->mailbox->name);
        $IMAPMessage = $IMAPmailbox->getMessage($message->message_number);

        $attachments = $IMAPMessage->getAttachments();
        $attachmentFiles = [];

        foreach ($attachments as $attachment) {

            if(!Storage::exists("public/mail/{$message->mailbox->id}/{$message->message_number}/{$attachment->getFilename()}")){
                Storage::put("public/mail/{$message->mailbox->id}/{$message->message_number}/{$attachment->getFilename()}", $attachment->getDecodedContent());
            }
            $url = Storage::url("public/mail/{$message->mailbox->id}/{$message->message_number}/{$attachment->getFilename()}");
            if($attachment->getDisposition() != 'ATTACHMENT'){
                $imgSrc = str_replace(['<', '>'], ['cid:', ''], $attachment->getStructure()->id);
                $message->body_html = str_replace($imgSrc, $url, $message->body_html);
            }
            else{
                $attachmentFiles[] = [
                    'url' => $url,
                    'name' => $attachment->getFilename(),
                    'size' => round(Storage::size("public/mail/{$message->mailbox->id}/{$message->message_number}/{$attachment->getFilename()}")/1024)
                ];
            }

        }

        return view('mailclient::readmessage', compact('message' , 'attachmentFiles'));
    }

}