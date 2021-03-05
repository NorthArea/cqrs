<?php


namespace App\Domain;


use App\Domain\Command\BaseTask;
use App\Domain\Command\CreateUserCommand;
use App\Domain\Command\SendEmailCommand;
use App\Domain\Query\GetUsersQuery;
use App\Service\Auth;

class DomainFacade
{
    /**
     * @var CreateUserCommand
     */
    private CreateUserCommand $createUserCommand;
    /**
     * @var SendEmailCommand
     */
    private SendEmailCommand $sendEmailCommand;
    /**
     * @var BaseTask
     */
    private BaseTask $complexCommand;
    /**
     * @var GetUsersQuery
     */
    private GetUsersQuery $query;

    public function __construct(CreateUserCommand $createUserCommand, SendEmailCommand $sendEmailCommand, BaseTask $complexCommand, GetUsersQuery $query)
    {
        $this->createUserCommand = $createUserCommand;
        $this->sendEmailCommand = $sendEmailCommand;
        $this->complexCommand = $complexCommand;
        $this->query = $query;
    }

    public function createUser(string $email, string $name): void
    {
        $this->createUserCommand->setEmail($email);
        $this->createUserCommand->setName($name);
        $this->sendEmailCommand->setEmail($email);
        $this->sendEmailCommand->setText("Hello {$name}!");
        $this->complexCommand->setCommand($this->createUserCommand);
        $this->complexCommand->setCommand($this->sendEmailCommand);
        $this->complexCommand->execute();
    }

    public function getUsers(): string
    {
        return $this->query->handle();
    }
}