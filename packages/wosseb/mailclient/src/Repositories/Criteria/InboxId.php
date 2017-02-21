<?php namespace Wosseb\Mailclient\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

/**
 * Class InboxName
 *
 * @package App\Repositories\Criteria
 */
class InboxId extends Criteria {

    /**
     * @var
     */
    private $inboxId;

    /**
     * InboxName constructor.
     * @param $inboxId
     */
    public function __construct($inboxId)
    {
        $this->inboxId = $inboxId;
    }

    /**
     * @param            $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        return $model->latest('date')->where('mailbox_id', $this->inboxId);
    }
}