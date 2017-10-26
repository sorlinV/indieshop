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
        $json = $this->get('jms_serializer')->serialize(
            $obj,
            "json"
            ,SerializationContext::create()->setGroups(array($group))
        );
        $response = new JsonResponse($json, 200, [], true);
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
        $post = $req->request->all();
        if (!empty($post['token']) && !empty($post['game']) &&
            !empty($post['title']) && !empty($post['description'])) {
            $em = $this->getDoctrine()->getManager();
            $gameDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["id"=>$post['game']]);

            $report = new Report($gameDb, $post['title'], $post['description']);
            $gameDb->addReport($report);
            $em->persist($gameDb);
            $em->persist($report);
            $em->flush();
            return new Response('Report added');
        }
        return new Response('wrong body need: token, name, desc, price, tags');
    }

    /**
     * @Route("/del/{id}", name="reportDel")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function reportDel(Request $req, $id):Response
    {
        $post = $req->request->all();
        if (!empty($post['token'])) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            $reportDb = $this->getDoctrine()
                ->getRepository(Report::class)
                ->findOneBy(["id"=>$id]);
            if ($userDb->getGrade() === "admin") {
                $em = $this->getDoctrine()->getManager();
                $em->remove($reportDb);
                $em->flush();
            }
            return new Response('Report delete');
        }
        return new Response('wrong body need: token');
    }

    /**
     * @Route("/all", name="reportAll")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function reportAll(Request $req):Response
    {
        $post = $req->request->all();
        if (!empty($post['token'])) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post['token']]);
            if ($userDb->getGrade() === "admin") {
                $reportsDb = $this->getDoctrine()
                    ->getRepository(Report::class)
                    ->findAll();
                return $this->jsonResponse($reportsDb, "Default");
            } else {
                return new Response('you are not an admin !');
            }
        }
        return new Response('wrong body need: token');
    }
}