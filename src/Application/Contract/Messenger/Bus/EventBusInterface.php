<?php


namespace App\Application\Contract\Messenger\Bus;


use App\Application\Contract\Messenger\Event\EventInterface;

interface EventBusInterface
{
    public function execute(EventInterface $command): void;
}