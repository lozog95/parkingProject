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
     * @Route("/home/{name}")
     */
    public function showAction($name){
       return $this->render('home/show.html.twig',['name'=>$name]);
    }
    /**
     * @Route("/home/{name}/notes", name="home_show_notes")
     * @Method("GET")
     */
    public function getNotes(){
        $notes = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];

        $data = [
            'notes'=>$notes,
        ];
        return new JsonResponse($data);
    }
}