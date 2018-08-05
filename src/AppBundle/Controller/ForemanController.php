<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Foreman;
use AppBundle\Form\ForemanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * Class ForemanController
 *
 * @Route("foreman")
 */
class ForemanController extends Controller
{

    /**
     * Lists all foreman entities.
     *
     * @Route("/", name="foreman_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $foremans = $em->getRepository(Foreman::class)->findAll();

        return $this->render('foreman/index.html.twig', array(
            'foremans' => $foremans,
        ));
    }

    /**
     * Creates a new foreman entity.
     *
     * @Route("/new", name="foreman_new")
     * @Method({"GET","POST"})
     * @Security("has_role('ADMIN')")

     */
    public function newAction(Request $request)
    {
        $foreman = new Foreman();
        $form = $this->createForm(ForemanType::class, $foreman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $encoder = $this->get('security.password_encoder');
            $foreman->setPassword($encoder->encodePassword($foreman, $form->get('password')->getData()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($foreman);
            $em->flush();

            return $this->redirectToRoute('foreman_show', array('id'=>$foreman->getId()));
        }

        return $this->render('foreman/new.html.twig', array(
            'foreman' => $foreman,
            'form' =>$form->createView(),
        ));
    }

    /**
     * Finds and displays a foreman entity.
     *
     * @Route("/{id}", name="foreman_show")
     * @Method("GET")
     */
    public function showAction(Foreman $foreman)
    {
        return $this->render('foreman/show.html.twig', array(
            'foreman' => $foreman,
        ));
    }

    /**
     * Displays a form to edit an existing foreman entity.
     *
     * @Route("/{id}/edit", name="foreman_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ADMIN')")
     */
    public function editAction(Request $request, Foreman $foreman)
    {
        $editForm = $this->createForm(ForemanType::class, $foreman);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('foreman_edit', array('id'=>$foreman->getId()));
        }

        return $this->render('foreman/edit.html.twig', array(
            'foreman' => $foreman,
            'edit_form' =>$editForm->createView(),
        ));
    }

    /**
     * Deletes a foreman entity.
     *
     * @Route("/delete/{id}", name="foreman_delete")
     * @Method("GET")
     * @Security("has_role('ADMIN')")
     */
    public function deleteAction(Request $request, Foreman $foreman)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($foreman);
        $em->flush();

        return $this->redirecttoRoute('foreman_index');
    }
}