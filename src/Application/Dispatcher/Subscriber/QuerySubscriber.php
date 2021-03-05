<?php


namespace App\Application\Dispatcher\Subscriber;


use App\Application\Contract\Messenger\Query\QueryInterface;
use App\Application\Dispatcher\Event\AfterHandleQuery;
use App\Application\Dispatcher\Event\BeforeHandleQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class QuerySubscriber implements EventSubscriberInterface
{
    public function beforeHandle(BeforeHandleQuery $query): void
    {
        print_r("--messenger.query.before (sync)--" . "\n");
    }

    public function afterHandle(AfterHandleQuery $query): void
    {
        print_r("--messenger.query.after (sync)--" . "\n");
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeHandleQuery::class => 'beforeHandle',
            AfterHandleQuery::class => 'afterHandle',
        ];
    }
}