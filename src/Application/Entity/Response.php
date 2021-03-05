<?php

namespace App\Application\Entity;

use App\Application\Repository\ResponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ResponseRepository::class)
 * @UniqueEntity("hash")
 */
class Response
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $hash;

    /**
     * @ORM\Column(type="text")
     */
    private $serialized;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getSerialized(): ?string
    {
        return $this->serialized;
    }

    public function setSerialized(string $serialized): self
    {
        $this->serialized = $serialized;

        return $this;
    }
}
