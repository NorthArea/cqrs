<?php


namespace App\Application\Dispatcher\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;
use Symfony\Component\Messenger\Event\WorkerMessageHandledEvent;
use Symfony\Component\Messenger\Event\WorkerMessageReceivedEvent;
use Symfony\Component\Messenger\Event\WorkerMessageRetriedEvent;
use Symfony\Component\Messenger\Event\WorkerRunningEvent;
use Symfony\Component\Messenger\Event\WorkerStartedEvent;
use Symfony\Component\Messenger\Event\WorkerStoppedEvent;

class WorkerSubscriber implements EventSubscriberInterface
{
    public function onWorkerHandled(WorkerMessageHandledEvent $event): void
    {
        print_r("--worker.handled (async)--" . "\n");
    }

    public function onWorkerFailed(WorkerMessageFailedEvent $event): void
    {
        print_r("--worker.failed (async)--" . "\n");
    }

    public function onWorkerReceived(WorkerMessageReceivedEvent $event): void
    {
        print_r("--worker.received (async)--" . "\n");
    }

    public function onWorkerRetried(WorkerMessageRetriedEvent $event): void
    {
        print_r("--worker.retried (async)--" . "\n");
    }

    public function onWorkerRunning(WorkerRunningEvent $event): void
    {
        print_r("--worker.running (async)--" . time() . "\n");
    }

    public function onWorkerStarted(WorkerStartedEvent $event): void
    {
        print_r("--worker.started (async)--" . "\n");
    }

    public function onWorkerStopped(WorkerStoppedEvent $event): void
    {
        print_r("--worker.stopped (async)--" . "\n");
    }

    public static function getSubscribedEvents(): array
    {
        return [
            WorkerMessageHandledEvent::class => 'onWorkerHandled',
            WorkerMessageFailedEvent::class => 'onWorkerFailed',
            WorkerMessageReceivedEvent::class => 'onWorkerReceived',
            WorkerMessageRetriedEvent::class => 'onWorkerRetried',
            WorkerRunningEvent::class => 'onWorkerRunning',
            WorkerStartedEvent::class => 'onWorkerStarted',
            WorkerStoppedEvent::class => 'onWorkerStopped',
        ];
    }
}