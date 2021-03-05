<?php

namespace App\Application\Dispatcher\Subscriber;

use App\Application\Entity\Log;
use App\Application\Entity\Request;
use App\Application\Entity\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Contracts\EventDispatcher\Event;

class KernelSubscriber implements EventSubscriberInterface
{
    protected static Log $log;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onKernelFinishRequest(Event $event): void
    {
        print_r("--kernel.finish_request (sync)--" . "\n");
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $serialize = serialize([$_COOKIE, $_GET, $_POST]);
        $hash = md5($serialize);

        $response = $this->entityManager->getRepository(Response::class)
            ->findOneBy(['hash' => $hash]);

        if(!isset($response)) {
            $response = new Response();
            $response->setHash(md5($serialize));
            $response->setSerialized($serialize);
            $this->entityManager->persist($response);
        }

        self::$log->setResponse($response);

        $this->entityManager->persist(self::$log);
        $this->entityManager->flush();
        print_r("--kernel.response (sync)--" . "\n");
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $serialize = serialize([$_COOKIE, $_GET, $_POST]);
        $hash = md5($serialize);

        $request = $this->entityManager->getRepository(Request::class)
            ->findOneBy(['hash' => $hash]);

        if(!isset($request)) {
            $request = new Request();
            $request->setHash($hash);
            $request->setSerialized($serialize);
            $this->entityManager->persist($request);
        }

        self::$log = new Log();
        self::$log->setRequest($request);

        $this->entityManager->persist(self::$log);

        $this->entityManager->flush();
        print_r("--kernel.request (sync)--" . "\n");
    }

    public function onKernelException(Event $event): void
    {
        print_r("--kernel.request (sync)--" . "\n");
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.finish_request' => 'onKernelFinishRequest',
            'kernel.response' => 'onKernelResponse',
            'kernel.request' => 'onKernelRequest',
            'kernel.exception' => 'onKernelException'
        ];
    }
}
