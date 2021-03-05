<?php


namespace App\Service;


use App\Service\Contract\AuthInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class AuthProxy implements AuthInterface
{
    /**
     * @var Auth
     */
    private Auth $auth;
    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(Auth $auth, CacheInterface $cache)
    {
        $this->auth = $auth;
        $this->cache = $cache;
    }

    public function createUser(string $email, string $name): bool
    {
        print_r("--service.auth.proxy--" . "\n");

        $this->cache->delete('get_user');

        return $this->auth->createUser($email, $name);
    }

    public function getAllUsers(): string
    {
        print_r("--service.auth.proxy--" . "\n");

        /*return $this->cache->get('get_user', function (ItemInterface $item) {
            return $this->auth->getAllUsers();
        });*/

        return $this->auth->getAllUsers();
    }
}