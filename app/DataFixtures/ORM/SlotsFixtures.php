<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 13.11.2017
 * Time: 21:49
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Slot;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class SlotsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 969; $i < 973; $i++){
            $slot = new Slot();
        $user = $manager->find(User::class, $i);
        $slot->setOwner($user);
        $manager->persist($slot);
    }
        $manager->flush();
    }

}