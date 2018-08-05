<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use AppBundle\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * Class AdminController
 *
 * @Route("admin")
 * @Security("has_role('ADMIN')")
 */
class AdminController extends Controller
{

    /**
     * Lists all admin entities.
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository(Admin::class)->findAll();


        return $this->render('admin/index.html.twig', array(
            'admins' => $admins,
        ));
    }

    /**
     * Creates a new admin entity.
     *
     *
     * @Route("/new", name="admin_new")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $encoder = $this->get('security.password_encoder');
            $admin->setPassword($encoder->encodePassword($admin, $form->get('password')->getData()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();

            return $this->redirectToRoute('admin_show', array('id'=>$admin->getId()));
        }

        return $this->render('admin/new.html.twig', array(
            'admin' => $admin,
            'form' =>$form->createView(),
        ));
    }

    /**
     * Finds and displays a admin entity.
     *
     * @Route("/{id}", name="admin_show")
     * @Method("GET")
     */
    public function showAction(Admin $admin)
    {
        return $this->render('admin/show.html.twig', array(
            'admin' => $admin,
        ));
    }

    /**
     * Displays a form to edit an existing admin entity.
     *
     * @Route("/{id}/edit", name="admin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Admin $admin)
    {
        $editForm = $this->createForm(AdminType::class, $admin);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_edit', array('id'=>$admin->getId()));
        }

        return $this->render('admin/edit.html.twig', array(
            'admin' => $admin,
            'edit_form' =>$editForm->createView(),
        ));
    }

    /**
     * Deletes a admin entity.
     *
     * @Route("/delete/{id}", name="admin_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Admin $admin)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();

        return $this->redirecttoRoute('admin_index');
    }
}