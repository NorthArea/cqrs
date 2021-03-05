<?php


namespace App\Application\Contract\Messenger\Bus;


use App\Application\Contract\Messenger\Query\QueryInterface;

interface QueryBusInterface
{
    public function handle(QueryInterface $query);
}