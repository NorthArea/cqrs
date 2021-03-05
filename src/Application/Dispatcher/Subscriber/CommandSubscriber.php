<?php


namespace App\Application\Dispatcher\Subscriber;


use App\Application\Contract\Messenger\Command\CommandInterface;
use App\Application\Dispatcher\Event\AfterExecuteCommandEvent;
use App\Application\Dispatcher\Event\BeforeExecuteCommandEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommandSubscriber implements EventSubscriberInterface
{
    public function beforeExecute(BeforeExecuteCommandEvent $command): void
    {
        print_r("--messenger.command.before (sync)--" . "\n");
    }

    public function afterExecute(AfterExecuteCommandEvent $command): void
    {
        print_r("--messenger.command.after (sync)--" . "\n");
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeExecuteCommandEvent::class => 'beforeExecute',
            AfterExecuteCommandEvent::class => 'afterExecute',
        ];
    }
}