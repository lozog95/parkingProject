<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 04.11.2017
 * Time: 12:28
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function showHome(){
        return $this->render('home/home.html.twig');
    }
    /**
     * @Route("/book", name="book")
     */
    public function showBook(){
       return $this->render('home/book.html.twig');
    }
    /**
     * @Route("/release", name="release")
     */
    public function showRelease(){
        return $this->render('home/release.html.twig');
    }
}