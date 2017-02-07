<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class LoadCategoryData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = [
            "Downloads",
            "Other",
            "News",
            "Finders",
            "Games",
            "Torrents",
            "WAP"
        ];

        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription("Sites with ".$name);
            $manager->persist($category);
        }
        $manager->flush();
    }
}