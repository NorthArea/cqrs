<?php


namespace App\Application\Messenger\Bus;


use App\Application\Contract\Messenger\Command\CommandInterface;
use App\Application\Contract\Messenger\Bus\CommandBusInterface;
use App\Application\Dispatcher\Event\AfterExecuteCommandEvent;
use App\Application\Dispatcher\Event\BeforeExecuteCommandEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBusInterface
{
    private MessageBusInterface $messageBus;
    private EventDispatcherInterface $dispatcher;

    public function __construct(MessageBusInterface $messageBus, EventDispatcherInterface $dispatcher)
    {
        $this->messageBus = $messageBus;
        $this->dispatcher = $dispatcher;
    }

    public function execute(CommandInterface $command): void
    {
        $this->dispatcher->dispatch(new BeforeExecuteCommandEvent($command));
        $this->messageBus->dispatch(new Envelope($command));
        $this->dispatcher->dispatch(new AfterExecuteCommandEvent($command));
    }
}