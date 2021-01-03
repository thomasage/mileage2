<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

final class CarFixtures extends Fixture implements DependentFixtureInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        /** @var User $user */
        $user = $this->userRepository->findByEmail('admin@localhost');

        $car = new Car();
        $car->name = 'My first car';
        $car->owner = $user;
        $car->uuid = Uuid::v4();
        $manager->persist($car);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
