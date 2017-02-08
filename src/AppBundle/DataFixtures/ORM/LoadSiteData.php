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
        ];

        $sitesData[] = [
            'title' => 'PC games FOREVER',
            'url' => 'https://games-pc.com',
            'email' => 'test@pcgames.com',
            'shortDescription' => 'Site with PC games',
            'description' => 'Discover the amazing depth, variety, and accessibility of PC games from EA Games, with exciting computer games in every genre.',
            'keywords' => 'games, pc',
        ];

        $sitesData[] = [
            'title' => 'The best game of world!',
            'url' => 'https://the-best-game.com',
            'email' => 'test@the-best.com',
            'shortDescription' => 'The best game in our site',
            'description' => 'See how well critics are rating the Best PC Video Games of All Time.',
            'keywords' => 'games, pc, best',
        ];

        $sitesData[] = [
            'title' => '25 Best PC Games',
            'url' => 'https://the-best-games.com',
            'email' => 'test@the-best-games.com',
            'shortDescription' => 'Our Quarterly Reports provide a handy list of the 25 best games for each platform',
            'description' => 'Our Quarterly Reports provide a handy list of the 25 best games for each platform, both for the current year so far and for all time. Here are the top PC games.',
            'keywords' => 'games, pc, best',
        ];

        $sitesData[] = [
            'title' => 'The Best PC Games of 2017',
            'url' => 'https://the2017games.com',
            'email' => 'test@the2017games.com',
            'shortDescription' => 'The Best PC Games of 2017.',
            'description' => 'The Best PC Games of 2017. Kick off the new year right with one of these more than 100 expertly reviewed ',
            'keywords' => 'games, pc, best',
        ];

        $sitesData[] = [
            'title' => 'The Best Indie Games on Game Jolt',
            'url' => 'https://thjolt.com',
            'email' => 'test@thejolt.com',
            'shortDescription' => 'The Best Indie Games on Game Jolt',
            'description' => 'The best indie games decided by the Game Jolt community of gamers and developers.',
            'keywords' => 'games, pc, best',
        ];

        $sitesData[] = [
            'title' => 'The 10 best Console games in the world right now',
            'url' => 'https://thjoltcon.com',
            'email' => 'test@thejoltcon.com',
            'shortDescription' => 'From the Sony PlayStation 4 to Valves Steam Machine',
            'description' => 'From the Sony PlayStation 4 to Valves Steam Machine, weve picked the best video games you can play across every console available.',
            'keywords' => 'games, pc, best',
        ];

        $sitesData[] = [
            'title' => 'Best mobile games of 2016',
            'url' => 'https://thjoltcon20116.com',
            'email' => 'test@thejoltcon2016.com',
            'shortDescription' => 'Looking for a new game to play on your mobile device?',
            'description' => 'Looking for a new game to play on your mobile device? Heres our pick of the best released in 2016 (so far).',
            'keywords' => 'games, pc, best',
        ];

        foreach ($sitesData as $siteData) {
            $site = new Site();
            $site->setTitle($siteData['title']);
            $site->setUrl($siteData['url']);
            $site->setEmail($siteData['email']);
            $site->setShortDescription($siteData['shortDescription']);
            $site->setDescription($siteData['description']);
            $site->setKeywords($siteData['keywords']);
            $site->setIsModerated(1);
            $site->setPasses(0);
            $site->setCategory($this->getReference('Downloads'));
            $manager->persist($site);
            $this->addReference($siteData['title'], $site);
        }
        $manager->flush();

    }

    public function getOrder()
    {

        return 2;
    }
}