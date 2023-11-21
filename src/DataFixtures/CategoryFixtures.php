<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = self::faker()->word();
        $name = mb_convert_case($category, ucfirst($category), 'UTF-8');
        CategoryFactory::createSequence();
    }
}
