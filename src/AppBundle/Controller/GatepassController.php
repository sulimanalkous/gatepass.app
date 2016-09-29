<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 08/09/16
 * Time: 10:55 ص
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Gatepass;
use AppBundle\Form\Type\GatepassType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;


class GatepassController extends Controller
{

    /**
     * @Route("/", name="gatepass_list")
     */
    public function listAction(Request $request)
    {
        $gatepass = $this->getDoctrine()->getRepository("AppBundle:Gatepass")->findAll();

        return $this->render('gatepass/index.html.twig', compact('gatepass'));
    }

    /**
     * @Route("/gatepass/create", name="gatepass_create")
     */
    public function createAction(Request $request)
    {
        $gatepass = new Gatepass();

        $form = $this->createForm(GatepassType::class, $gatepass);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $user->getId();
            $gatepass->setUser($user);

            $dateNow = new \DateTime('now');

            $gatepass->setCreatedAt($dateNow);

            $em = $this->getDoctrine()->getManager();

            foreach ($gatepass->getItems() as $item) {
                $item->setCreatedAt($dateNow);
                $item->setGatepass($gatepass);
            }

            $em->persist($gatepass);
            $em->flush();
        }

        return $this->render('gatepass/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/gatepass/edit/{id}", name="gatepass_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gatepass = $em->getRepository('AppBundle:Gatepass')->find($id);

        if (!$gatepass) {
            throw $this->createNotFoundException('No gatepass found for id ' . $id);
        }

        $originalItems = new ArrayCollection();

        // create an ArrayCollection of the current Gatepass objects in the database
        foreach ($gatepass->getItems() as $item) {
            $originalItems->add($item);
        }

        $form = $this->createForm(GatepassType::class, $gatepass);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $user->getId();
            $gatepass->setUser($user);

            $dateNow = new \DateTime('now');

            $gatepass->setUpdatedAt($dateNow);


            // remove the relationship between the item and the gatepass
            foreach ($originalItems as $item) {
                if (false === $gatepass->getItems()->contains($item)) {
                    // remove the gatepass from the Item
                    $item->setGatepass(null);
                    $em->remove($item);
                }
            }

            foreach ($gatepass->getItems() as $item) {
                    $item->setUpdatedAt($dateNow);
                    $item->setGatepass($gatepass);
            }

            $em->persist($gatepass);
            $em->flush();
        }

        return $this->render('gatepass/edit.html.twig', ['form' => $form->createView()]);
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