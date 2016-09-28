<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 08/09/16
 * Time: 11:29 ص
 */

namespace AppBundle\Controller;


use AppBundle\Entity\National;
use AppBundle\Entity\GatepassType;
use AppBundle\Entity\Section;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class CommonController extends Controller
{

    /**
     * @Route("/common/{table}", name="common_list")
     */
    public function listAction($table, Request $request)
    {
        $datas = null;
        $headerName = '';
        switch ($table) {
            case 'national':
                $datas = $this->getDoctrine()->getRepository('AppBundle:National')->findAll();
                $headerName = 'الجنسيات';
                break;
            case 'gatepass_type':
                $datas = $this->getDoctrine()->getRepository('AppBundle:GatepassType')->findAll();
                $headerName = 'أنواع التصاريح';
                break;
            case 'section':
                $datas = $this->getDoctrine()->getRepository('AppBundle:Section')->findAll();
                $headerName = 'الأقسام';
                break;

            default:
                throw new Exception('no table found!');

        }
        return $this->render('common/index.html.twig', compact('datas', 'headerName', 'table'));
    }

    /**
     * @Route("/common/create/{table}", name="common_create")
     */
    public function createAction($table, Request $request)
    {
        $form = null;
        $obj = null;
        $headerName = null;

        switch ($table) {
            case 'national':
                $obj = new National();
                $headerName = 'الجنسيات';
                break;
            case 'gatepass_type':
                $obj = new GatepassType();
                $headerName = 'أنواع التصاريح';
                break;
            case 'section':
                $obj = new Section();
                $headerName = 'الأقسام';
                break;

            default:
                throw new Exception('no table found!');
        }

        $form = $this->createCommonForm($obj);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            $this->addFlash('notice', 'تم خفظ البيانات');

            return $this->redirect("/common/{$table}");
        }

        return $this->render('common/create.html.twig', [
            'form' => $form->createView(),
            'table' => $table,
            'headerName' => $headerName
        ]);
    }

    /**
     * @Route("/common/edit/{id}/{table}", name="common_edit")
     */
    public function editAction($id, $table, Request $request)
    {
        $form = null;
        $obj = null;
        $headerName = null;

        switch ($table) {
            case 'national':
                $obj = $this->getDoctrine()->getRepository('AppBundle:National')->find($id);
                $headerName = 'الجنسيات';
                break;
            case 'gatepass_type':
                $obj = $this->getDoctrine()->getRepository('AppBundle:GatepassType')->find($id);
                $headerName = 'أنواع التصاريح';
                break;
            case 'section':
                $obj = $this->getDoctrine()->getRepository('AppBundle:Section')->find($id);
                $headerName = 'الأقسام';
                break;

            default:
                throw new Exception('no table found!');
        }

        $form = $this->createCommonForm($obj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($obj);
            $em->flush();

            $this->addFlash('notice', 'تم خفظ البيانات');

            return $this->redirect("/common/{$table}");
        }

        return $this->render('common/edit.html.twig', [
            'form' => $form->createView(),
            'table' => $table,
            'headerName' => $headerName
        ]);

        return $this->render('common/edit.html.twig');
    }

    /**
     * @Route("/common/delete/{id}/{table}", name="common_delete")
     */
    public function deleteAction($id, $table, Request $request)
    {
        return $this->render('common/delete.html.twig');
    }


    /**
     * @Route("/common/details/{id}/{table}", name="common_details")
     */
    public function detailsAction($id, $table, Request $request)
    {
        return $this->render('common/details.html.twig');
    }

    /**
     * @param string $obj
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createCommonForm($obj)
    {
        $form = $this->createFormBuilder($obj)
            ->add('name', TextType::class, ['label' => 'إسم'])
            ->add('save', SubmitType::class, ['label' => 'حفظ', 'attr' => ['class' => 'btn-primary']])
            ->getForm();
        return $form;
    }


}