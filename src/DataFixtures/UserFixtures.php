<?php

namespace App\DataFixtures;

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
            'bio' => 'Salut je suis l`admin root, je suis ici pour administrer le site !',
        ]);
        UserFactory::createOne([
            'firstname' => 'Peter',
            'lastname' => 'Parker',
            'email' => 'user@example.com',
            'roles' => ['ROLE_USER'],
            'bio' => 'Salut je suis l`utilisateur lambda du site !',
        ]);
        UserFactory::createMany(10);
    }
}
