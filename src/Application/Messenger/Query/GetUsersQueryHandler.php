<?php


namespace App\Application\Messenger\Query;


use App\Application\Contract\Messenger\Query\QueryHandlerInterface;
use App\Domain\DomainFacade;

class GetUsersQueryHandler implements QueryHandlerInterface
{
    /**
     * @var DomainFacade
     */
    private DomainFacade $facade;

    public function __construct(DomainFacade $facade)
    {
        $this->facade = $facade;
    }

    public function __invoke(GetUsersQuery $query): string
    {
        return $this->facade->getUsers();
    }
}