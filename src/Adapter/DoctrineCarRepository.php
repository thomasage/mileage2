<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mileage\Garage\Domain\Car\Car as BaseCar;
use Mileage\Garage\Domain\Car\CarId;
use Mileage\Garage\Domain\Car\CarName;
use Mileage\Garage\Domain\Car\CarRepository as BaseCarRepository;
use Mileage\Garage\Domain\Car\OwnerId;
use Symfony\Component\Uid\Uuid;

final class DoctrineCarRepository implements BaseCarRepository
{
    private EntityManagerInterface $entityManager;
    private CarRepository $carRepository;
    private UserRepository $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        CarRepository $carRepository,
        UserRepository $userRepository
    ) {
        $this->entityManager = $entityManager;
        $this->carRepository = $carRepository;
        $this->userRepository = $userRepository;
    }

    public function getByOwnerId(OwnerId $ownerId): \Generator
    {
        $owner = $this->userRepository->findByUid(Uuid::fromString((string) $ownerId));
        if (!$owner) {
            return;
        }

        foreach ($this->carRepository->findBy(['owner' => $owner]) as $car) {
            yield self::toDomainEntity($car);
        }
    }

//    public function save(BaseRecord $record): void
//    {
//        $car = $this->carRepository->findByUuid(Uuid::fromString((string) $record->getCarId()));
//        if (!$car) {
//            throw new \RuntimeException(sprintf('Unable to find car %s.', $record->getCarId()));
//        }
//
//        $entity = new Record();
//        $entity->car = $car;
//        $entity->date = $record->getDate();
//        $entity->mileage = $record->getMileage();
//        $entity->uuid = Uuid::fromString((string) $record->getId());
//        $this->entityManager->persist($entity);
//        $this->entityManager->flush();
//    }

    private static function toDomainEntity(Car $car): BaseCar
    {
        return new BaseCar(
            new CarId((string) $car->uuid),
            new CarName((string) $car->name),
            $car->enabled,
            $car->brand,
            $car->model,
            $car->licensePlate
        );
    }
}
