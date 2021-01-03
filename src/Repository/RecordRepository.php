<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Car;
use App\Entity\Record;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class RecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Record::class);
    }

    /**
     * @return \Generator<Record>
     */
    public function findByCar(Car $car): \Generator
    {
        $builder = $this->createQueryBuilder('record')
            ->andWhere('record.car = :car')
            ->setParameter('car', $car)
            ->addOrderBy('record.date', 'ASC');

        yield from $builder->getQuery()->getResult();
    }
}
