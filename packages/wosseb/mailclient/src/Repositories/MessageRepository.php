<?php
/**
 * Created by PhpStorm.
 * User: Luxite
 * Date: 2017-02-10
 * Time: 12:24
 */

namespace Wosseb\Mailclient\Repositories;


use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class MessageRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return 'Wosseb\Mailclient\Message';
    }

    public function deleteOldMessages($mailbox_id, $messages)
    {
        return $this->model->where('mailbox_id', $mailbox_id)->whereNotIn('message_id', $messages->pluck('id'))->delete();
    }

}