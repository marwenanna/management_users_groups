<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Agrp;
use App\Entity\Busr;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        $faker = Factory::create('en_US');
        for($i=0;$i<=6;$i++){
            $grp = new Agrp();
            $grp->setName($faker->name);
            $manager->persist($grp);
            for($j=0;$j<= mt_rand(2, 5);$j++){
                $usr = new Busr();
                $usr->setGrp($grp)
                    ->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName)
                    ->setEmail($faker->email)
                    ->setState($faker->boolean)
                    ->setDate($faker->dateTimeBetween('-5 months'));
                $manager->persist($usr);

            }

        }

        $manager->flush();
    }
}
