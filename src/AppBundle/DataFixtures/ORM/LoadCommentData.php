<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $commentsData[] = [
            'name' => 'Nick',
            'message' => 'Good site!',
        ];

        $commentsData[] = [
            'name' => 'Mark',
            'message' => 'Bad',
        ];

        $commentsData[] = [
            'name' => 'Lisa',
            'message' => 'Nice! I like it!',
        ];

        $commentsData[] = [
            'name' => 'John',
            'message' => 'I recommend this site for everyone!',
        ];

        $commentsData[] = [
            'name' => 'Natali',
            'message' => 'I didnt wait it! Its nice!',
        ];

        $commentsData[] = [
            'name' => 'Kelly',
            'message' => 'Nice downloads!',
        ];

        foreach ($commentsData as $commentData) {
            $comment = new Comment();
            $comment->setName($commentData['name']);
            $comment->setMessage($commentData['message']);
            $comment->setSite($this->getReference('Games for mobile'));
            $manager->persist($comment);
        }

        $manager->flush();

    }

    public function getOrder()
    {

        return 3;
    }
}