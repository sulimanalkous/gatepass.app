<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 08/09/16
 * Time: 11:29 ص
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NationalController extends Controller
{

    /**
     * @Route("/national", name="national_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('national/index.html.twig');
    }

    /**
     * @Route("/national/create", name="national_create")
     */
    public function createAction(Request $request)
    {
        return $this->render('national/create.html.twig');
    }

    /**
     * @Route("/national/edit/{id}", name="national_edit")
     */
    public function editAction($id, Request $request)
    {
        return $this->render('national/edit.html.twig');
    }

    /**
     * @Route("/national/delete/{id}", name="national_delete")
     */
    public function deleteAction($id, Request $request)
    {
        return $this->render('national/delete.html.twig');
    }


    /**
     * @Route("/national/details/{id}", name="national_details")
     */
    public function detailsAction($id, Request $request)
    {
        return $this->render('national/details.html.twig');
    }


}