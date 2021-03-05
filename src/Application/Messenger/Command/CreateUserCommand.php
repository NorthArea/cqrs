<?php


namespace App\Application\Messenger\Command;


use App\Application\Contract\Messenger\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserCommand implements CommandInterface
{
    private string $email;
    private string $name;

    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName():string
    {
        return $this->name;
    }
}