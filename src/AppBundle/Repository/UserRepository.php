<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 13.11.2017
 * Time: 23:43
 */


namespace AppBundle\Repository;

    use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
    use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}