<?php


namespace App\Domain\Contract\Command;


interface CommandInterface
{
    public function execute(): void;
}