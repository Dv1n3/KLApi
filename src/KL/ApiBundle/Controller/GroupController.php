<?php
/**
 * Created by PhpStorm.
 * User: dvine
 * Date: 07/04/2018
 * Time: 11:51
 */

namespace KL\ApiBundle\Controller;

use KL\ApiBundle\Entity\Groupe;
use KL\ApiBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

class GroupController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/groups")
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function getGroupsAction(Request $request)
    {
        $groups = $this->getDoctrine()
            ->getRepository('KLApiBundle:Groupe')
            ->findAll();

        if (empty($groups)) {
            return new JsonResponse(["message", 'Groups not found'], Response::HTTP_NOT_FOUND);
        }

        return $groups;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/groups/{id}")
     *
     * @param $id
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function getGroupAction($id, Request $request)
    {
        $group = $this->getDoctrine()
            ->getRepository('KLApiBundle:Groupe')
            ->find($id);

        if (empty($group)) {
            return new JsonResponse(["message", 'Group not found'], Response::HTTP_NOT_FOUND);
        }
        return $group;

    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/groups")
     */
    public function postGroupssAction(Request $request)
    {
        $groupe = new Groupe();
        $groupe->setNom($request->get('nom'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($groupe);
        $em->flush();

        return $groupe;
    }

    /**
     * @Rest\View()
     * @Rest\Put("/groups/{id]")
     */
    public function putGroupAction(Request $request)
    {
        $groupe = $this->getDoctrine()
            ->getRepository('KLApiBundle:Groupe')
            ->find($request->get('id'));
    if (empty($groupe)){
        return new JsonResponse(['message' => 'place not found'], Response::HTTP_NOT_FOUND);
    }


    }
}