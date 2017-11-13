<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 13.11.2017
 * Time: 21:49
 */
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new User();
            $product->setEmail('user'.$i.'@gmail.com');
            $manager->persist($product);
        }
        $manager->flush();
    }
}