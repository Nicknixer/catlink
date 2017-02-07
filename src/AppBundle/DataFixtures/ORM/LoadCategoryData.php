<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
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
            $this->addReference($name, $category); // For using in LoadSiteData.php
        }
        $manager->flush();
    }

    public function getOrder()
    {

        return 1;
    }
}