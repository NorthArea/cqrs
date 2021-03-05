<?php


namespace App\Service\Contract;


interface AuthInterface
{
    public function createUser(string $email, string $name): bool;
    public function getAllUsers(): string;
}