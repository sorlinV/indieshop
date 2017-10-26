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
 * @Route("rate")
 */
class RateController extends Controller {

    private function jsonResponse ($obj, $group):Response {
        $json = $this->get('jms_serializer')->serialize(
            $obj,
            "json"
            ,SerializationContext::create()->setGroups(array($group))
        );
        $response = new JsonResponse($json, 200, [], true);
        return $response;
    }

    /**
     * @Route("/add", name="rateAdd")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function rateAdd(Request $req):Response
    {
        $post = $req->request->all();
        if (!empty($post['token']) && !empty($post['game']) && !empty($post['rate'])) {
            $em = $this->getDoctrine()->getManager();
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            $gameDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["id"=>$post['game']]);
            $rate = new Rate($userDb,$gameDb,$post['rate']);
            $gameDb->addRate($rate);
            $userDb->addRate($rate);
            $em->persist($rate);
            $em->persist($userDb);
            $em->persist($gameDb);
            $em->flush();
            return new Response('Rate added');
        }
        return new Response('wrong body need: token, name, desc, price, tags');
    }

    /**
     * @Route("/del/{id}", name="rateDel")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function rateDel(Request $req, $id):Response
    {
        $post = $req->request->all();
        if (!empty($post['token'])) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            $rateDb = $this->getDoctrine()
                ->getRepository(Rate::class)
                ->findOneBy(["id"=>$id]);
            if ($rateDb->getUser()->verifToken($userDb->getToken())) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($rateDb);
                $em->flush();
            }
            return new Response('Rate added');
        }
        return new Response('wrong body need: token, name, desc, price, tags');
    }
}
