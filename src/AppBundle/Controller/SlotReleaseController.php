<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 17.11.2017
 * Time: 22:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Slot;
use AppBundle\Repository\SlotsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class SlotReleaseController extends Controller
{


public function fillFormData(){
    $repository=$this->getDoctrine()->getRepository(Slot::class);

}
    /**
     * @Route("/release/{id}", name="releaseId")
     */
public function releaseSlotById($id){
    $manager=$this->getDoctrine()->getManager();
    $slot=$manager->getRepository(Slot::class)->find($id);
    if (!$slot){
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }

    $slot->setReleaseStatus(true);
    $manager->flush();
    return $this->redirectToRoute("home");
}
}