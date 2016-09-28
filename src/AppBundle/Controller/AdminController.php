<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 26/09/16
 * Time: 09:31 ص
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{

    /**
     * @Route("/admin/users", name="users_list")
     */
    public function usersAction(Request $request) {

        $users = $this->getDoctrine()->getRepository("AppBundle:User")->findAll();

        return $this->render('admin/users.html.twig', compact('users'));

    }

    /**
     * @param $id
     * @param Request $request
     * @Route("/admin/users/{id}", name="users_view")
     */
    public function usersViewAction($id, Request $request) {

    }

}