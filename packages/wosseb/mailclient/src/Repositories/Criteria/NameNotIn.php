<?php namespace Wosseb\Mailclient\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

/**
 * Class InboxName
 *
 * @package App\Repositories\Criteria
 */
class NameNotIn extends Criteria {

    /**
     * @var
     */
    private $names;

    /**
     * InboxName constructor.
     * @param $names
     */
    public function __construct($names)
    {
        $this->names = $names;
    }

    /**
     * @param            $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        return $model->whereNotIn('name', $this->names);
    }
}