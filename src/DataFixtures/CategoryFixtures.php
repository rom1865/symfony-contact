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
        $fileJson = __DIR__.'/data/Category.json';
        $Categorys = json_decode(file_get_contents($fileJson), true);
        CategoryFactory::createSequence($Categorys);
    }


}
