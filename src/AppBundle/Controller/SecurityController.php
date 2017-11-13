<?php
/**
 * Created by PhpStorm.
 * User: lozog
 * Date: 13.11.2017
 * Time: 22:28
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
/**
 * @Route("/login", name="security_login")
 */
public function loginAction(){
// get the login error if there is one
    $authUtils=$this->get('security.authentication_utils');
    $error = $authUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authUtils->getLastUsername();

    return $this->render('security/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
}


}