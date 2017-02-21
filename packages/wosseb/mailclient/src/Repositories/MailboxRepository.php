<?php namespace Wosseb\Mailclient\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

/**
 * Class MailboxRepository
 * @package App\Repositories
 */
class MailboxRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Wosseb\Mailclient\Mailbox';
    }


    public function deleteOldMailboxes($mailboxes)
    {
        return $this->model->whereNotIn('name', $mailboxes)->delete();
    }

}