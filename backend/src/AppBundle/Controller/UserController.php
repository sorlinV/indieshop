<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="user_login")
     * @Method({"GET", "POST"})
     */
     public function login()
     {
         if ($request->getMethod() == 'POST') {
             $form->bindRequest($request);
             $data = $form->getData();
         }
         var_dump($data);
         return new Responce("Coucou");
     }
}
