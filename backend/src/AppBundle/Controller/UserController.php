<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Cart;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller {


    private function jsonResponse ($obj, $group):Response {
        $json = $this->get('jms_serializer')->serialize(
            $obj,
            "json"
            ,SerializationContext::create()->setGroups(array($group))
        );
        $response = new JsonResponse($json, 200, [], true);
        return $response;
    }

    private function connectMail($post){
        $em = $this->getDoctrine()->getManager();
        $userDb = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(Array("mail" => $post['usermail']));
        $userDb->generateToken();
        $em->persist($userDb);
        $em->flush();
        return $userDb;
    }

    private function connectUsername($post){
        $em = $this->getDoctrine()->getManager();
        $userDb = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(Array("username" => $post['usermail']));
        $userDb->generateToken();
        $em->persist($userDb);
        $em->flush();
        return $userDb;
    }

    /**
     * @Route("/all", name="allUser")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function allUser(Request $req):Response
    {
        $usersDb = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        return $this->jsonResponse($usersDb, "normal");
    }

    /**
     * @Route("/login", name="loginUser")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function loginUser(Request $req):Response
    {
        $post = $req->request->all();
        if (!empty($post['usermail']) && !empty($post['password'])) {
            if (strpos($post['usermail'], '@') !== false) {
                $userDb = $this->connectMail($post);
            } else {
                $userDb = $this->connectUsername($post);
            }
            return $this->jsonResponse($userDb, "token");
        }
        return new Response('wrong body need: usermail, password');
    }


    /**
     * @Route("/one/{name}", name="oneUser")
     * @Method("POST")
     * @return Response
     */
    function user($name):Response {
        $userDb = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(Array("username" => $name));
        return $this->jsonResponse($userDb, "normal");
    }



    /**
     * @Route("/register", name="registerUser")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request):Response
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
                $cart->setUser($u);
                $u->setCart($cart);
                $u->generateToken();
                $em->persist($cart);
                $em->persist($u);
                $em->flush();
                return $this->jsonResponse($u, "token");
            } else {
                return new Response('User already in use');
            }
        }
        return new Response('wrong from or request for register');
    }


    /**
     * @Route("delete", name="deleteUser")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request):Response
    {
        $post = $request->request->all();
        if (!empty($post["username"]) && !empty($post['token']))
        {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(Array(
                    "username" => $post["username"]));
            if (!empty($userDb) && $userDb->getUsername() === $post["username"]
                && explode('&', $userDb->generateToken())[1] === explode('&', $post['token']))
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
     * @Route("/modify/{name}", name="modifyUser")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function update(Request $request, $name):Response
    {
        $post = $request->request->all();
        $userDb = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(Array(
                "username" => $name));
        if (!empty($post['token']) && $userDb->verifToken($post['token']))
        {
            if (!empty($post['username'])) {
                $tmpUser = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneBy(Array(
                        "username" => $post['username']));
                if (empty($tmpUser)) {
                    $userDb->setUsername($post['username']);
                } else {
                    return new Response('Username already in use');
                }
            }
            if (!empty($post['password'])) {
                $userDb->setSalt(hash("sha256", rand()));
                $userDb->setPassword(hash("sha256", $post["password"] . $userDb->getSalt()));
                $userDb->generateToken();
            }
            if (!empty($post['mail'])) {
                $tmpUser = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneBy(Array(
                        "mail" => $post['mail']));
                if (empty($tmpUser)) {
                    $userDb->setMail($post['mail']);
                } else {
                    new Response('Mail already in use');
                }
            }
            $em = $this->getDoctrine()->getManager();
            $em->remove($userDb);
            $em->flush();
            return $this->jsonResponse($userDb, "token");
        }
        return new Response('Username already in use');
    }
}
