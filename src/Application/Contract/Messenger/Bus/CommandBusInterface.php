<?php


namespace App\Application\Contract\Messenger\Bus;


use App\Application\Contract\Messenger\Command\CommandInterface;

interface CommandBusInterface
{
    public function execute(CommandInterface $command): void;
}