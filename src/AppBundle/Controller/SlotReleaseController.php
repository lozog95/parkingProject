<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 17.11.2017
 * Time: 22:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Reservation;
use AppBundle\Entity\Slot;
use AppBundle\Repository\SlotsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SlotReleaseController extends Controller
{
    /**
     * @Route("/release", name="release")
     */
    public function showRelease(EntityManager $manager, Request $request)
    {
        $slot = new Slot();
        $form = $this->createFormBuilder($slot)
//            ->add('id', EntityType::class, array(
//            'class' => 'AppBundle\Entity\Slot', 'choice_label' => 'id', 'query_builder' => function(EntityRepository $er){
//                return $er->createQueryBuilder('s')->where('s.owner = :usr')->setParameter('usr', $this->getUser());
//                }))
            ->add('releaseStart', DateType::class, array('data' => new \DateTime()))
            //'placeholder' => array(
            //'year' => date('Y'), 'month' => date('m'), 'day'=> date('d')
            // )))
            ->add('releaseEnd', DateType::class, array('data' => new \DateTime()))
            //'placeholder' => array(
            //'year' => date('Y'), 'month' => date('m'), 'day'=> date('d')
            //)))
            ->add('submit', SubmitType::class, array('label' => 'Release'))
            ->getForm();
        $manager = $this->getDoctrine()->getManager();
        $userSlots = $manager->getRepository(Slot::class)->findOneBy(array('owner' => $this->getUser()));
//        if($userSlots==null){
//            $releaseDetails = $manager->getRepository(Slot::class)->findOneBy(array('owner'=>$this->getUser()));
//            $reservedAlready = $manager->getRepository(Reservation::class)->findOneBy(array('slot' => $releaseDetails));
//        }else{
//            $releaseDetails=null;
//            $reservedAlready=null;
//        }

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $slot = $form->getData();
            $slotTemp = $manager->getRepository(Slot::class)->findOneBy(array('owner' => $this->getUser()));
            $slotTemp->setReleaseStart($slot->getReleaseStart());
            $slotTemp->setReleaseEnd($slot->getReleaseEnd());
            $slotTemp->setReleaseStatus(true);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/release.html.twig', array(
            'entities' => $userSlots,
//            'releases' => $releaseDetails,
//            'reserved' => $reservedAlready,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/cancelRelease", name="cancelRelease")
     */
    public function cancelRelease(EntityManager $manager){
        $slot=$manager->getRepository(Slot::class)->findOneBy(array('owner' => $this->getUser()));
        $slot->setReleaseEnd(NULL);
        $slot->setReleaseStart(NULL);
        $slot->setReleaseStatus(false);
        $manager->flush();
        return $this->redirectToRoute("release");
    }


}