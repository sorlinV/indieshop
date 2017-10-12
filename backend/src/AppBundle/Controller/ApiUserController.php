<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
/**
 * User controller.
 *
 * @Route("api")
 */
class ApiUserController extends Controller
{
    /**
     * @Route("/user", name="user_test")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function test(Request $request)
    {
        die("plpo");
        //$wsse = $this->container->get('AppBundle\Security\Authentication\Provider\WsseProvider');
//        var_dump($wsse->authenticate('a'));
//        return new Response(json_encode($wsse));
        return new Response();
    }


}
