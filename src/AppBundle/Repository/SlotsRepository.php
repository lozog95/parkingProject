<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 17.11.2017
 * Time: 23:08
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Slot;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class SlotsRepository extends EntityRepository
{
    public function loadReleases(){
        $query = $this->createQueryBuilder('s')
            ->where('s.isReleased = :state')
            ->setParameter('state', 'true')->getQuery();
        return $query;
    }
}