<?php


namespace App\Application\Contract\Dispatcher\Event;


use App\Application\Contract\Messenger\Query\QueryInterface;

abstract class AbstractQueryEvent
{
    /**
     * @var QueryInterface
     */
    private QueryInterface $query;

    public function __construct(QueryInterface $query)
    {
        $this->query = $query;
    }

    public function getQuery(): QueryInterface
    {
        return $this->query;
    }
}