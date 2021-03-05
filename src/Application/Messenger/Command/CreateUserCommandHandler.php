<?php


namespace App\Application\Messenger\Command;


use App\Application\Contract\Messenger\Command\CommandHandlerInterface;
use App\Domain\DomainFacade;


class CreateUserCommandHandler implements CommandHandlerInterface
{
    /**
     * @var DomainFacade
     */
    private DomainFacade $facade;

    public function __construct(DomainFacade $facade)
    {
        $this->facade = $facade;
    }

    public function __invoke(CreateUserCommand $command)
    {
        $this->facade->createUser($command->getEmail(), $command->getName());
    }
}