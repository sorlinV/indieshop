<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\Rate;
use AppBundle\Entity\Tag;
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
 * @Route("cart")
 */
class CartController extends Controller {

    private function jsonResponse ($obj, $group):Response {
        $json = $this->get('jms_serializer')->serialize(
            $obj,
            "json"
            ,SerializationContext::create()->setGroups(array($group))
        );
        $response = new JsonResponse($json, 200, [], true);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }


    /**
     * @Route("/add", name="cartAdd")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function cartAdd(Request $req):Response
    {
        $post = $req->request->all();
        if (!empty($post['token']) && !empty($post['game'])) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            $gameDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["id"=>$post['game']]);

            $userDb->getCart()->addGame($gameDb);
            $em = $this->getDoctrine()->getManager();
            $em->persist($userDb);
            $em->persist($gameDb);
            $em->flush();
            return new Response('Rate added');
        }
        return new Response('wrong body need: token, name, desc, price, tags');
    }

    /**
     * @Route("/buy", name="cartBuy")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function cartBuy(Request $req):Response
    {
        $post = $req->request->all();
        if (!empty($post['token'])) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            $em = $this->getDoctrine()->getManager();
            foreach ($userDb->getCart()->getGames() as $game)
            {
                $gameDb = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneBy(["id"=>$game->getId()]);
                $userDb->getCart()->removeGame($gameDb);
                $userDb->addBuyed($gameDb);
                $gameDb->addBuyer($userDb);
                $em->persist($userDb);
                $em->persist($gameDb);
            }
            $em->flush();
            return new Response('Rate added');
        }
        return new Response('wrong body need: token, name, desc, price, tags');
    }

    /**
     * @Route("/del", name="cartDel")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function cartDel(Request $req):Response
    {
        $post = $req->request->all();
        if (!empty($post['token']) && !empty($post['game'])) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            $gameDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["id"=>$post['game']]);
            $userDb->getCart()->removeGame($gameDb);
            $em = $this->getDoctrine()->getManager();
            $em->remove($userDb);
            $em->flush();
            return new Response('Rate deled');
        }
        return new Response('wrong body need: token, name, desc, price, tags');
    }
}
