<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 21.11.2017
 * Time: 23:17
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Reservation;
use AppBundle\Entity\Slot;
use AppBundle\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{

//    public function showBook(EntityManager $manager){
//        $slot = $manager->getRepository(Slot::class)->findBy(array('isReleased' => 'false'));
//        return $this->render('home/book.html.twig', array('entities' => $slot));
//    }
    /**
     * @Route("/book", name="book")
     */
    public function bookPlace(EntityManager $em, Request $request)
    {
        $reservation = new Reservation();
        $form = $this->createFormBuilder($reservation)
            ->add('slot', EntityType::class, array(
                'class' => 'AppBundle\Entity\Slot',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')->where('s.isReleased = true');
                },
                'choice_label' => 'id',
                'placeholder' => 'Choose a slot...'
            ))
            //do i really need dates? not on this stage...
//            ->add('start', DateType::class, array(
//                'widget' => 'single_text',
//                // this is actually the default format for single_text
//                'format' => 'yyyy-MM-dd',
//            ))
//            ->add('end', DateType::class, array(
//                'widget' => 'single_text',
//                // this is actually the default format for single_text
//                'format' => 'yyyy-MM-dd',
//                'html5' => 'true',))
            ->add('submit', SubmitType::class, array('label' => 'Book'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();
            $slotNumber=$form->get('slot')->getData();
            $slot=$em->getRepository(Slot::class)->find($slotNumber);
            $slot->setReleaseStatus(false);
            $reservation->setStart($slot->getReleaseStart());
            $reservation->setEnd($slot->getReleaseEnd());
//            $slot->setReleaseStart(NULL);
//            $slot->setReleaseEnd(NULL);
            $reservation->setGuest($this->getUser());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($reservation);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        $slot = $em->getRepository(Slot::class)->findBy(array('isReleased' => '1'));
        return $this->render('home/book.html.twig',array(
            'form' => $form->createView(),
            'entities' => $slot,
        ));
    }

}