<?php

namespace App\Application\Entity;

use App\Application\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class Log
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $request_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $response_id;

    /**
     * @ManyToOne(targetEntity="Request")
     * @JoinColumn(name="request_id", referencedColumnName="id")
     */
    private $request;

    /**
     * @ManyToOne(targetEntity="Response")
     * @JoinColumn(name="response_id", referencedColumnName="id")
     */
    private $response;


    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRequestId(): ?int
    {
        return $this->request_id;
    }

    public function setRequestId(?int $request_id): self
    {
        $this->request_id = $request_id;

        return $this;
    }

    public function getResponseId(): ?int
    {
        return $this->response_id;
    }

    public function setResponseId(?int $response_id): self
    {
        $this->response_id = $response_id;

        return $this;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }

    public function setRequest(? Request $request): void
    {
        $this->request = $request;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(? Response $response): void
    {
        $this->response = $response;
    }
}
