<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RecordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=RecordRepository::class)
 */
final class Record
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
     * @ORM\ManyToOne(targetEntity=Car::class)
     * @ORM\JoinColumn(nullable=false)
     */
    public Car $car;

    /**
     * @ORM\Column(type="date")
     */
    public \DateTimeInterface $date;

    /**
     * @ORM\Column(type="integer")
     */
    public int $mileage;
}
