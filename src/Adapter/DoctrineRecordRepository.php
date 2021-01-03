<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Entity\Record;
use App\Repository\CarRepository;
use App\Repository\RecordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mileage\Recording\Domain\Record\CarId;
use Mileage\Recording\Domain\Record\Record as BaseRecord;
use Mileage\Recording\Domain\Record\RecordId;
use Mileage\Recording\Domain\Record\RecordRepository as BaseRecordRepository;
use Symfony\Component\Uid\Uuid;

final class DoctrineRecordRepository implements BaseRecordRepository
{
    private EntityManagerInterface $entityManager;
    private CarRepository $carRepository;
    private RecordRepository $recordRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CarRepository $carRepository,
        RecordRepository $recordRepository
    ) {
        $this->entityManager = $entityManager;
        $this->carRepository = $carRepository;
        $this->recordRepository = $recordRepository;
    }

    public function getByCar(CarId $carId): \Generator
    {
        $car = $this->carRepository->findByUuid(Uuid::fromString((string) $carId));
        if (!$car) {
            throw new \RuntimeException(sprintf('Unable to find car %s.', $carId));
        }

        foreach ($this->recordRepository->findByCar($car) as $record) {
            yield self::toDomainEntity($record);
        }
    }

    private static function toDomainEntity(Record $record): BaseRecord
    {
        return new BaseRecord(
            new RecordId((string) $record->uuid),
            new CarId((string) $record->car->uuid),
            $record->date,
            $record->mileage
        );
    }

    public function save(BaseRecord $record): void
    {
        $car = $this->carRepository->findByUuid(Uuid::fromString((string) $record->getCarId()));
        if (!$car) {
            throw new \RuntimeException(sprintf('Unable to find car %s.', $record->getCarId()));
        }

        $entity = new Record();
        $entity->car = $car;
        $entity->date = $record->getDate();
        $entity->mileage = $record->getMileage();
        $entity->uuid = Uuid::fromString((string) $record->getId());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
