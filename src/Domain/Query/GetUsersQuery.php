<?php


namespace App\Domain\Query;


use App\Domain\Contract\Query\QueryInterface;
use App\Service\AuthProxy;

class GetUsersQuery implements QueryInterface
{
    /**
     * @var AuthProxy
     */
    private AuthProxy $auth;

    public function __construct(AuthProxy $auth)
    {
        $this->auth = $auth;
    }

    public function handle(): string
    {
        return $this->auth->getAllUsers();
    }
}