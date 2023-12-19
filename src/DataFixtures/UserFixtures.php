<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'firstname' => 'Tony',
            'lastname' => 'Stark',
            'email' => 'root@example.com',
            'roles' => ['ROLE_ADMIN'],
        ]);
        UserFactory::createOne([
            'firstname' => 'Peter',
            'lastname' => 'Parker',
            'email' => 'user@example.com',
            'roles' => ['ROLE_USER'],
        ]);
        UserFactory::createMany(10);
    }
}
