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
    {/*
        $user = new User();
        $user->setUsername('admin');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);
        $email = "admin@application.com";
        $role="ROLE_ADMIN";
        $user->setRole($role);
        $user->setEmail($email);
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername('user' . $i);
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, 'user_1234');
            $user->setPassword($password);
            $email = "user" . $i . "@application.com";
            $user->setEmail($email);
            $manager->persist($user);
        }
        $manager->flush();*/
    }
}