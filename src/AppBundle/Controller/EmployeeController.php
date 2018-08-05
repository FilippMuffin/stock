<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Employee;
use AppBundle\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */

/**
 * Class EmployeeController
 *
 * @Route("employee")
 */
class EmployeeController extends Controller
{

    /**
     * Lists all employee entities.
     *
     * @Route("/", name="employee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository(Employee::class)->findAll();


        return $this->render('employee/index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     *
     * @Route("/new", name="employee_new")
     * @Method({"GET","POST"})
     * @Security("has_role('SUPER_USER')")

     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $encoder = $this->get('security.password_encoder');
            $employee->setPassword($encoder->encodePassword($employee, $form->get('password')->getData()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employee_show', array('id'=>$employee->getId()));
        }

        return $this->render('employee/new.html.twig', array(
            'employee' => $employee,
            'form' =>$form->createView(),
        ));
    }

    /**
     * Finds and displays a employee entity.
     *
     * @Route("/{id}", name="employee_show")
     * @Method("GET")
     */
    public function showAction(Employee $employee)
    {
        return $this->render('employee/show.html.twig', array(
             'employee' => $employee,
        ));
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="employee_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('SUPER_USER')")
     */
    public function editAction(Request $request, Employee $employee)
    {
        $editForm = $this->createForm(EmployeeType::class, $employee);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employee_edit', array('id'=>$employee->getId()));
        }

        return $this->render('employee/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' =>$editForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     *
     * @Route("/delete/{id}", name="employee_delete")
     * @Method("GET")
     * @Security("has_role('SUPER_USER')")
     */
    public function deleteAction(Request $request, Employee $employee)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($employee);
        $em->flush();

        return $this->redirecttoRoute('employee_index');
    }
}