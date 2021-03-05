<?php


namespace App\Application\Messenger\Middleware;


use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class SimpleMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        print_r("--middleware--" . "\n");
        return $stack->next()->handle($envelope, $stack);
    }
}