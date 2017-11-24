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
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    /**
     * @Route("/book", name="book")
     */
    public function showBook(EntityManager $manager){
        $slot = $manager->getRepository(Slot::class)->findBy(array('isReleased' => 'false'));
        return $this->render('home/book.html.twig', array('entities' => $slot));
    }

    /**
     * @Route("/book/{number}/{from}/{to}", name="book_place")
     */
    public function bookPlace($number, $from, $to){
        $manager = $this->getDoctrine()->getManager();
        $slot = $manager->getRepository('AppBundle:Slot')->find($number);
        $reservation = new Reservation();
        $reservation->setSlot($slot);
        $reservation->setGuest($this->getUser());
        $reservation->setFrom($from);
        $reservation->setTo($to);
        $manager->persist($reservation);
        $manager->flush();
    }
}