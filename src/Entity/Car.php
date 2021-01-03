<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
final class Car implements \Stringable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public ?int $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     */
    public Uuid $uuid;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    public User $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public string $name;

    /**
     * @ORM\Column(type="boolean")
     */
    public bool $enabled = true;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $model;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $licensePlate;

    public function __toString(): string
    {
        return $this->name;
    }
}
