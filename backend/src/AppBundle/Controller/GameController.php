<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
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
 * @Route("game")
 */
class GameController extends Controller {

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
     * @Route("/add", name="gameAdd")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function gameAdd(Request $req):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token) && !empty($post->name) &&
            !empty($post->desc) && !empty($post->price) &&
            !empty($post->tags)) {
            $em = $this->getDoctrine()->getManager();
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post->token]);
            $game = new Game($post->name, $post->desc, $post->price, $userDb);
            $userDb->addCreation($game);
            foreach (explode(',', trim($post->tags)) as $tag)
            {
                $tmpTag = new Tag($game, $tag);
                $game->addTag($tmpTag);
                $em->persist($tmpTag);
            }
            $em->persist($userDb);
            $em->persist($game);
            $em->flush();
            return $this->jsonResponse('Game added', 'Default');
        }
        return $this->jsonResponse('wrong body need: token, name, desc, price, tags', 'Default');
    }

    /**
     * @Route("/modify/{id}", name="gameModify")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function gameModify(Request $req):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token) && !empty($post->name) &&
            !empty($post->desc) && !empty($post->price) &&
            !empty($post->tags)) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post->token]);
            $game = new Game($post->name, $post->desc, $post->price, $userDb, $post->tags);
            $userDb->addCreation($game);
            $em = $this->getDoctrine()->getManager();
            $em->persist($userDb);
            $em->persist($game);
            $em->flush();
            return $this->jsonResponse($userDb, "token");
        }
        return $this->jsonResponse('wrong body need: token, name, desc, price, tags', 'Default');
    }

    /**
     * @Route("/delete/{id}", name="gameDelete")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function gameDelete(Request $req, $id):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token)) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token"=>$post->token]);
            $gameDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["id"=>$id]);
            foreach ($gameDb->getCreators() as $creator) {
                if ($userDb->verifToken($creator->getToken())) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($userDb);
                    $em->flush();
                    return $this->jsonResponse('Game deleted', 'Default');
                }
            }
        }
        return $this->jsonResponse('wrong body need: token', 'Default');
    }

    /**
     * @Route("/adduser/{id}", name="gameAdduser")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function gameAdduser(Request $req, $id):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token) && !empty($post->usermail)) {
            if (strpos($post->usermail, '@') !== false) {
                $userDb = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneBy(["mail"=>$post->usermail]);
            } else {
                $userDb = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneBy(["username"=>$post->usermail]);
            }
            $gameDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["id"=>$id]);
            $gameDb->addCreator($userDb);
            $userDb->addCreation($gameDb);
            $em = $this->getDoctrine()->getManager();
            $em->persist($gameDb);
            $em->persist($userDb);
            $em->flush();
            return $this->jsonResponse('user added to game', 'Default');
        }
        return $this->jsonResponse('wrong body need: token, usermail', 'Default');
    }

    /**
     * @Route("/all", name="gameAll")
     * @Method("POST")
     * @return Response
     */
    public function gameAll():Response
    {
        $gamesDb = $this->getDoctrine()
            ->getRepository(Game::class)
            ->findAll();
        return $this->jsonResponse($gamesDb, 'Default');
    }

    /**
     * @Route("/buy", name="gameBuy")
     * @Method("POST")
     * @param Request $req
     * @return Response
     */
    public function gameBuy(Request $req):Response
    {
        $post = json_decode($req->getContent());
        if (!empty($post->token)) {
            $userDb = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(["token" => $post->token]);
            $gamesDb = $this->getDoctrine()
                ->getRepository(Game::class)
                ->findOneBy(["user_id" => $userDb->getId()]);
            return $this->jsonResponse($gamesDb, 'Default');
        }
        return $this->jsonResponse('wrong body need: token', 'Default');
    }

    /**
     * @Route("/one/{id}", name="gameOne")
     * @Method("POST")
     * @return Response
     */
    public function gameOne($id):Response
    {
        $gamesDb = $this->getDoctrine()
            ->getRepository(Game::class)
            ->findOneBy(["id"=>$id]);
        return $this->jsonResponse($gamesDb, 'Default');
    }
}
