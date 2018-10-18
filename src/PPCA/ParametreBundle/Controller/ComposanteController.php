<?php

namespace PPCA\ParametreBundle\Controller;

use PPCA\ParametreBundle\Entity\Composante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Composante controller.
 *
 */
class ComposanteController extends Controller
{
    /**
     * Lists all composante entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $composantes = $em->getRepository('ParametreBundle:Composante')->findAll();

        return $this->render('composante/index.html.twig', array(
            'composantes' => $composantes,
        ));
    }

    /**
     * Creates a new composante entity.
     *
     */
    public function newAction(Request $request)
    {
        $composante = new Composante();
        $form = $this->createForm('PPCA\ParametreBundle\Form\ComposanteType', $composante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($composante);
            $em->flush();

            return $this->redirectToRoute('admin_parametre_composante_index');
        }

        return $this->render('composante/new.html.twig', array(
            'composante' => $composante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a composante entity.
     *
     */
    public function showAction(Request $request, Composante $composante)
    {
        $deleteForm = $this->createDeleteForm($composante);
        $showForm = $this->createForm('PPCA\ParametreBundle\Form\ComposanteType', $composante);
        $showForm->handleRequest($request);


        return $this->render('composante/show.html.twig', array(
            'composante' => $composante,
            'show_form' => $showForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing composante entity.
     *
     */
    public function editAction(Request $request, Composante $composante)
    {
        $deleteForm = $this->createDeleteForm($composante);
        $editForm = $this->createForm('PPCA\ParametreBundle\Form\ComposanteType', $composante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_parametre_composante_edit', array('id' => $composante->getId()));
        }

        return $this->render('composante/edit.html.twig', array(
            'composante' => $composante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a composante entity.
     *
     */
    public function deleteAction(Request $request, Composante $composante)
    {
        $form = $this->createDeleteForm($composante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($composante);
            $em->flush();
        }

        return $this->redirectToRoute('admin_parametre_composante_index');
    }

    /**
     * Creates a form to delete a composante entity.
     *
     * @param Composante $composante The composante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Composante $composante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_parametre_composante_delete', array('id' => $composante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
