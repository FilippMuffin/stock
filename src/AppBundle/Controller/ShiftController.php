<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shift;
use AppBundle\Form\ShiftType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Shift controller.
 *
 * @Route("shift")
 */
class ShiftController extends Controller
{
    /**
     * Lists all shift entities.
     *
     * @Route("/", name="shift_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shifts = $em->getRepository(Shift::class)->findAll();

        return $this->render('shift/index.html.twig', array(
            'shifts' => $shifts,
        ));
    }

    /**
     * Creates a new shift entity.
     *
     * @Route("/new", name="shift_new")
     * @Method({"GET", "POST"})ы
     *
     * @Security("has_role('SUPER_USER')")

     */
    public function newAction(Request $request)
    {
        $shift = new Shift();
        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();

            return $this->redirectToRoute('shift_show', array('id' => $shift->getId()));
        }

        return $this->render('shift/new.html.twig', array(
            'shift' => $shift,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a shift entity.
     *
     * @Route("/{id}", name="shift_show")
     * @Method("GET")
     */
    public function showAction(Shift $shift)
    {
        return $this->render('shift/show.html.twig', array(
            'shift' => $shift,
        ));
    }

    /**
     * Displays a form to edit an existing shift entity.
     *
     * @Route("/{id}/edit", name="shift_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('SUPER_USER')")
     */
    public function editAction(Request $request, Shift $shift)
    {
        $editForm = $this->createForm(ShiftType::class, $shift);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shift_edit', array('id' => $shift->getId()));
        }

        return $this->render('shift/edit.html.twig', array(
            'shift' => $shift,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a shift entity.
     *
     * @Route("/delete/{id}", name="shift_delete")
     * @Method("GET")
     * @Security("has_role('SUPER_USER')")
     */
    public function deleteAction(Request $request, Shift $shift)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($shift);
        $em->flush();

        return $this->redirectToRoute('shift_index');
    }
}
