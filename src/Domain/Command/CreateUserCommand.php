<?php


namespace App\Domain\Command;


use App\Domain\Contract\Command\CommandInterface;
use App\Service\Auth;
use App\Service\AuthProxy;
use App\Service\Slack;

class CreateUserCommand implements CommandInterface
{
    /**
     * @var AuthProxy
     */
    private AuthProxy $auth;
    private string $email;
    private string $name;

    public function __construct(AuthProxy $auth)
    {
        $this->auth = $auth;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function execute(): void
    {
        $this->auth->createUser($this->email, $this->name);
        $slack = new Slack();
        $slack->send("Create user {$this->email} with name {$this->name}");
    }
}