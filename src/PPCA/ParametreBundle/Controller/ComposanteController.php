<?php

namespace PPCA\ParametreBundle\Controller;

use PPCA\ParametreBundle\Entity\Composante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


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
    public function indexAction(Request $request)
    {
        $grid = $this->get('grid');

        $source = new Entity('ParametreBundle:Composante');

        $grid->setSource($source);

        $rowAction = new RowAction('Détails', 'admin_parametre_composante_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Composante:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_parametre_composante_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Composante:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        /*$rowAction = new RowAction('Supprimer', 'admin_parametre_composante_delete');
        $rowAction->manipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Composante:delete', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);*/

        // Set the selector of the number of items per page
        $grid->setLimits(array(10, 15, 20));



        return $grid->getGridResponse('composante/index.html.twig');
    }

    /**
     * Creates a new composante entity.
     *
     */
    public function newAction(Request $request)
    {
        $composante = new Composante();
        $form = $this->createForm('PPCA\ParametreBundle\Form\ComposanteType', $composante, array(
            'action' => $this->generateUrl('admin_parametre_composante_new'),
            'method' => 'POST',
        ));
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
        $editForm = $this->createForm('PPCA\ParametreBundle\Form\ComposanteType', $composante, array(
            'action' => $this->generateUrl('admin_parametre_composante_edit', array('id' => $composante->getId())),
            'method' => 'POST',
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_parametre_composante_index');
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
