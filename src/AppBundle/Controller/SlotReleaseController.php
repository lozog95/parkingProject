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
        $slot=new Slot();
        $form = $this->createFormBuilder($slot)
//            ->add('id', EntityType::class, array(
//            'class' => 'AppBundle\Entity\Slot', 'choice_label' => 'id', 'query_builder' => function(EntityRepository $er){
//                return $er->createQueryBuilder('s')->where('s.owner = :usr')->setParameter('usr', $this->getUser());
//                }))
            ->add('releaseStart', DateType::class, array('placeholder' => array(
                'year' => date('Y'), 'month' => date('m'), 'day'=> date('d')
            )))
            ->add('releaseEnd', DateType::class, array('placeholder' => array(
                'year' => date('Y'), 'month' => date('m'), 'day'=> date('d')
            )))
            ->add('submit', SubmitType::class, array('label' => 'Release'))
            ->getForm();
        $manager = $this->getDoctrine()->getManager();
        $userSlots = $manager->getRepository(Slot::class)->findBy(array('owner' => $this->getUser(), 'isReleased' => false));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $slot=$form->getData();
            $slotTemp=$manager->getRepository(Slot::class)->findOneBy(array('owner'=>$this->getUser()));
            $slotTemp->setReleaseStart($slot->getReleaseStart());
            $slotTemp->setReleaseEnd($slot->getReleaseEnd());
            $slotTemp->setReleaseStatus(true);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/release.html.twig', array(
            'entities' => $userSlots,
            'form' => $form->createView(),
            ));
    }

}