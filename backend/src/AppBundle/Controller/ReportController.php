<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\Rate;
use AppBundle\Entity\Report;
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
 * @Route("report")
 */
class ReportController extends Controller {

    private function jsonResponse ($obj, $group):Response {
        if (gettype($obj) === 'string')
        {
            $obj = ["message" => $obj];
        }
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
     * @Route("/add", name="reportAdd")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function reportAdd(Request $req):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token) && !empty($post->game) &&
            !empty($post->title) && !empty($post->description)) {
            $em = $this->getDoctrine()->getManager();
            $gameDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["id"=>$post->game]);

            $report = new Report($gameDb, $post->title, $post->description);
            $gameDb->addReport($report);
            $em->persist($gameDb);
            $em->persist($report);
            $em->flush();
            return $this->jsonResponse('Report added', 'Default');
        }
        return $this->jsonResponse('wrong body need: token, name, desc, price, tags', 'Default');
    }

    /**
     * @Route("/del/{id}", name="reportDel")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function reportDel(Request $req, $id):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token)) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post->token]);
            $reportDb = $this->getDoctrine()
                ->getRepository(Report::class)
                ->findOneBy(["id"=>$id]);
            if ($userDb->getGrade() === "admin") {
                $em = $this->getDoctrine()->getManager();
                $em->remove($reportDb);
                $em->flush();
            }
            return $this->jsonResponse('Report delete', 'Default');
        }
        return $this->jsonResponse('wrong body need: token', 'Default');
    }

    /**
     * @Route("/all", name="reportAll")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function reportAll(Request $req):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token)) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post->token]);
            if ($userDb->getGrade() === "admin") {
                $reportsDb = $this->getDoctrine()
                    ->getRepository(Report::class)
                    ->findAll();
                return $this->jsonResponse($reportsDb, "Default");
            } else {
                return $this->jsonResponse('you are not an admin !', 'Default');
            }
        }
        return $this->jsonResponse('wrong body need: token', 'Default');
    }
}
