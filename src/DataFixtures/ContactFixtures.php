<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ContactFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // CategoryFactory::createMany(6);
        ContactFactory::createMany(150, function () {
            $category = null;
            if (true === ContactFactory::faker()->boolean(90)) {
                $category = CategoryFactory::random();
            }

            return [
                'category' => $category,
                // 'category' => $faker->boolean(90) ? CategoryFactory::random() : null, --> equivalent au if au dessus.
            ];
        });
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
