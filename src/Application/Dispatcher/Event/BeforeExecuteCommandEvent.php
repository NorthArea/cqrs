<?php


namespace App\Application\Dispatcher\Event;


use App\Application\Contract\Dispatcher\Event\AbstractCommandEvent;
use Symfony\Contracts\EventDispatcher\Event;

class BeforeExecuteCommandEvent extends AbstractCommandEvent
{

}