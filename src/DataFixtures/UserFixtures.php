<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Uid\Uuid;

final class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->createdAt = new \DateTimeImmutable();
        $user->email = 'admin@localhost';
        $user->password = $this->passwordEncoder->encodePassword($user, 'admin');
        $user->roles = ['ROLE_ADMIN'];
        $user->uuid = Uuid::v4();
        $manager->persist($user);

        $manager->flush();
    }
}
