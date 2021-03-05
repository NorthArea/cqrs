<?php

namespace App\Application\Controller;

use App\Application\Contract\Messenger\Bus\CommandBusInterface;
use App\Application\Contract\Messenger\Bus\QueryBusInterface;
use App\Application\Messenger\Command\CreateUserCommand;
use App\Application\Messenger\Query\GetUsersQuery;
use App\Service\Slack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimpleController extends AbstractController
{
    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $commandBus;
    /**
     * @var QueryBusInterface
     */
    private QueryBusInterface $queryBus;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    #[Route('/simple')]
    public function index(): Response
    {
        $result = $this->queryBus->handle(new GetUsersQuery());

        return $this->json([
            'users' => $result
        ]);
    }

    #[Route('/simple/{email}/{name}')]
    public function create(string $email, string $name): Response
    {
        $command = new CreateUserCommand($email, $name);
        $this->commandBus->execute($command);

        return $this->json([
            'succeed' => true
        ]);
    }
}
