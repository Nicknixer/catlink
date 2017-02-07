<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Site;

class LoadSiteData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sitesData[] = [
            'title' => 'Games for mobile',
            'url' => 'https://games.com',
            'email' => 'test@games.com',
            'shortDescription' => 'Site with games for mobile',
            'description' => 'The Best Free Mobile Games! Play arcade games, puzzle games, racing games, adventure games & more online now!',
            'keywords' => 'games, mobile',
            'isModerated' => 1,
            'passes' => 0
        ];

        foreach ($sitesData as $siteData) {
            $site = new Site();
            $site->setTitle($siteData['title']);
            $site->setUrl($siteData['url']);
            $site->setEmail($siteData['email']);
            $site->setShortDescription($siteData['shortDescription']);
            $site->setDescription($siteData['description']);
            $site->setKeywords($siteData['keywords']);
            $site->setIsModerated($siteData['isModerated']);
            $site->setPasses($siteData['passes']);
            $site->setCategory($this->getReference('Downloads'));
            $manager->persist($site);
        }
        $manager->flush();

    }

    public function getOrder()
    {

        return 2;
    }
}