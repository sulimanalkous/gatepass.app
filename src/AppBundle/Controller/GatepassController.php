<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 08/09/16
 * Time: 10:55 ص
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GatepassController extends Controller
{

    /**
     * @Route("/", name="gatepass_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('gatepass/index.html.twig');
    }

    /**
     * @Route("/gatepass/create", name="gatepass_create")
     */
    public function createAction(Request $request)
    {
        return $this->render('gatepass/create.html.twig');
    }

    /**
     * @Route("/gatepass/edit/{id}", name="gatepass_edit")
     */
    public function editAction($id, Request $request)
    {
        return $this->render('gatepass/edit.html.twig');
    }

    /**
     * @Route("/gatepass/delete/{id}", name="gatepass_delete")
     */
    public function deleteAction($id, Request $request)
    {
        return $this->render('gatepass/delete.html.twig');
    }


    /**
     * @Route("/gatepass/details/{id}", name="gatepass_details")
     */
    public function detailsAction($id, Request $request)
    {
        return $this->render('gatepass/details.html.twig');
    }

}