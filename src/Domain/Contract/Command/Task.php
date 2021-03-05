<?php


namespace App\Domain\Contract\Command;


use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class Task implements CommandInterface
{
    /**
     * @var array CommandInterface
     */
    private array $commands = [];

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $dispatcher;

    public function setCommand(CommandInterface $command): void
    {
        $this->commands[] = $command;
    }

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $this->dispatcher->dispatch($command);
            $command->execute();
        }
    }
}