<?php


namespace App\Application\Contract\Dispatcher\Event;


use App\Application\Contract\Messenger\Command\CommandInterface;

abstract class AbstractCommandEvent
{
    /**
     * @var CommandInterface
     */
    private CommandInterface $command;

    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}