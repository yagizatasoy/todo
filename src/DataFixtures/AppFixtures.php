<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $developer = new Developer();
            $developer->setName('Developer ' . $i + 1);
            $developer->setDifficultyMultiplier($i + 1);
            $manager->persist($developer);
        }

        $manager->flush();
    }
}
