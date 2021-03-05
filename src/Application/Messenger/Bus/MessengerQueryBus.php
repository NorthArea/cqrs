<?php


namespace App\Application\Messenger\Bus;


use App\Application\Contract\Messenger\Query\QueryInterface;
use App\Application\Contract\Messenger\Bus\QueryBusInterface;
use App\Application\Dispatcher\Event\AfterHandleQuery;
use App\Application\Dispatcher\Event\BeforeHandleQuery;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBusInterface
{
    use HandleTrait {
        handle as handleQuery;
    }

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(MessageBusInterface $queryBus, EventDispatcherInterface $eventDispatcher)
    {
        $this->messageBus = $queryBus;
        $this->eventDispatcher = $eventDispatcher;
    }

    /** @return mixed */
    public function handle(QueryInterface $query)
    {
        $this->eventDispatcher->dispatch(new BeforeHandleQuery($query));
        $return = $this->handleQuery($query);
        $this->eventDispatcher->dispatch(new AfterHandleQuery($query));
        return $return;
    }
}