<?php


namespace App\Domain\Contract\Query;


use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class Group implements QueryInterface
{
    /**
     * @var array QueryInterface
     */
    private array $query = [];

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $dispatcher;

    public function setCommand(QueryInterface $query): void
    {
        $this->query[] = $query;
    }

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function execute(): void
    {
        foreach ($this->query as $query) {
            $this->dispatcher->dispatch($query);
            $query->execute();
        }
    }
}