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
        $user = new User();
        $user->setUsername('admin');

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        $email = "admin@admin.com";
        $user->setEmail($email);
        $manager->persist($user);
        $manager->flush();
    }
}