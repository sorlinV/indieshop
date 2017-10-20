<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    private function userToJson(User $u) {
        $user = ["username" => $u->getUsername(), "mail" => $u->getMail(), $u->getRoles()];
        return json_encode($user);
    }

    /**
     * @Route("", name="user_all")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $userDb = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        $json = "";
        foreach ($userDb as $u) {
            $json += $this->userToJson($u);
        }
        return new Response($json);
    }

    /**
     * @Route("", name="user_register")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $post = $request->request->all();
        if (!empty($post["username"]) && !empty($post["password"]) && !empty($post["mail"]))
        {
            if (empty($this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(Array("username" => $post["username"]))))
            {
                $cart = new Cart();
                $em = $this->getDoctrine()->getManager();
                $u = new User();
                $u->setUsername($post["username"]);
                $u->setMail($post["mail"]);
                $u->setGrade("user");
                $u->setSalt(hash("sha256", rand()));
                $u->setPassword(hash("sha256", $post["password"] . $u->getSalt()));
                $u->setCart($cart);
                $em->persist($cart);
                $em->persist($u);
                $em->flush();
                $_SESSION['user'] = $u->getId();
                return new Response(json_encode($u));
            } else {
                return new Response('User already in use');
            }
        }
        return new Response('wrong from or request');
    }


    /**
     * @Route("/delete", name="user_delete")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        $post = $request->request->all();
        if (!empty($post["username"]) && !empty($post["password"]))
        {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(Array(
                    "username" => $post["username"]));
            if (!empty($userDb) && $userDb->getUsername() === $post["username"]
                && $userDb->getPassword() === hash("sha256", $post["password"] . $userDb->getSalt()))
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($userDb);
                $em->flush();
                return new Response('User remove');
            } else {
                return new Response('Wrong password or username');
            }
        }
        return new Response('Wrong form or request');
    }

    /**
     * @Route("", name="user_update")
     * @Method("UPDATE")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $post = $request->request->all();
        if (!empty($post["username"]) && !empty($post["password"]))
        {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(Array(
                    "username" => $post["username"]));
            if (!empty($userDb) && $userDb->getUsername() === $post["username"]
                && $userDb->getPassword() === hash("sha256", $post["password"] . $userDb->getSalt()))
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($userDb);
                $em->flush();
                return new Response('User remove');
            } else {
                return new Response('Wrong password or username');
            }
        }
        return new Response('Wrong form or request');
    }
}
