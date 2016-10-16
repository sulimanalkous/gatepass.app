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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Process\Process;
use Knp\Snappy\Pdf;
use JonnyW\PhantomJs\Client;

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

            $this->addFlash('notice', 'تم إضافة التصريح بنجاح');

            return $this->redirectToRoute('gatepass_list');
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
            throw $this->createNotFoundException('لا يجد تصريح بهذا الرقم ' . $id);
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

            $this->addFlash('notice', 'تم تعديل التصريح بنجاح');

            return $this->redirectToRoute('gatepass_list');
        }

        return $this->render('gatepass/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gatepass/delete/{id}", name="gatepass_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gatepass $gatepass)
    {

//        $gatepass = $em->getRepository('AppBundle:Gatepass')->find($id);
//
//        if (!$gatepass) {
//            throw $this->createNotFoundException('لا يجد تصريح بهذا الرقم ' . $id);
//        }

        $form = $this->createDeleteForm($gatepass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gatepass);
            $em->flush();

            $this->addFlash('notice', 'تم مسح التصريح رقم #');

        }

        return $this->redirectToRoute('gatepass_list');
    }


    /**
     * @Route("/gatepass/details/{id}", name="gatepass_details")
     * @Method("GET")
     */
    public function detailsAction(Request $request, Gatepass $gatepass)
    {
        if ($gatepass === null)
            throw new Exception("لا يوجد تصريح بهذا الرقم");

        $em = $this->getDoctrine()->getManager();
//        $gatepass = $em->getRepository('AppBundle:Gatepass')->find($id);
        $deleteForm = $this->createDeleteForm($gatepass);

//        if (!$gatepass) {
//            throw $this->createNotFoundException('No gatepass found for id ' . $id);
//        }

        return $this->render('gatepass/details.html.twig', [
            'gatepass' => $gatepass,
            'delete_form' => $deleteForm->createView()
        ]);
    }

    /**
     * @Route("/gatepass/print/{id}", name="gatepass_print")
     */
    public function printAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $gatepass = $em->getRepository('AppBundle:Gatepass')->find($id);

        if (!$gatepass) {
            throw $this->createNotFoundException('No gatepass found for id ' . $id);
        }

        $this->load('gatepass/print.html.twig', ['gatepass' => $gatepass]);
        $filename = 'gatepass.pdf';
        $this->response($filename);

        /***** TESTING KnpSnappyBundle *****/
//        $path = __DIR__."/../../../storage".DIRECTORY_SEPARATOR. md5(uniqid()). ".pdf";

//        $html = $this->renderView('gatepass/print.html.twig', ['gatepass' => $gatepass]);
//        $snappy = $this->get('knp_snappy.pdf');
//
//        return new Response(
//            $snappy->getOutputFromHtml($html),
//            200,
//            array(
//                'Content-Type'          => 'application/pdf',
//                'Content-Disposition'   => 'attachment; filename="file.pdf"',
//                'User-Agent'            => 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.41 Safari/535.1'
//            )
//        );

        /**** TESTING PRINT *****/
//        return $this->render('gatepass/print.html.twig', ['gatepass' => $gatepass]);

    }

    protected $view;
    protected $pdf;


    public function load($filename, array $data = []){
        $view = $this->renderView($filename, $data);
        $this->pdf = $this->captureImage($view);
    }

    protected function captureImage($view){
        $path = $this->writeFile($view);
        $this->phantomProcess($path)->setTimeout(10)->mustRun();
        return $path;
    }

    protected function writeFile($view){
        file_put_contents($path = __DIR__."/../../../storage".DIRECTORY_SEPARATOR. md5(uniqid()). ".pdf", $view);
        return $path;
    }

    protected function phantomProcess($path){
        $phantomPath = __DIR__ . '/../../../web/phantomjs';
        return new Process($phantomPath. " --debug=true capture.js ". $path);
    }

    /**
     * @param $filename
     */
    public function response($filename)
    {
        $response = new Response(file_get_contents($this->pdf), 200, [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'inline; filename="' . $filename . '"', // attachment = downloading
            'Content-Transfer-Encoding' => 'binary',
            'Content-Type' => 'application/pdf',
        ]);

        unlink($this->pdf);
        $response->send();
    }


    /**
     * @param Gatepass $gatepass The Gatepass Entity
     * @return \Symfony\Component\Form\Form the Form
     */
    private function createDeleteForm(Gatepass $gatepass)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gatepass_delete', ['id' => $gatepass->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }

}