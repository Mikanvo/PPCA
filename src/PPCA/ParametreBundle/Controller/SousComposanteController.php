<?php

namespace PPCA\ParametreBundle\Controller;

use PPCA\ParametreBundle\Entity\SousComposante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;



/**
 * Souscomposante controller.
 *
 */
class SousComposanteController extends Controller
{
    /**
     * Lists all sousComposante entities.
     *
     */
    public function indexAction(Request $request)
    {

        $grid = $this->get('grid');

        $source = new Entity('ParametreBundle:SousComposante');

        $grid->setSource($source);

        $rowAction = new RowAction('Détails', 'admin_parametre_souscomposante_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:SousComposante:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_parametre_souscomposante_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:SousComposante:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

/*        $rowAction = new RowAction('Supprimer', 'admin_parametre_souscomposante_delete');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:SousComposante:delete', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);*/


        return $grid->getGridResponse('souscomposante/index.html.twig');
    }

    /**
     * Creates a new sousComposante entity.
     *
     */
    public function newAction(Request $request)
    {
        $sousComposante = new Souscomposante();
        $form = $this->createForm('PPCA\ParametreBundle\Form\SousComposanteType', $sousComposante, array(
                'action' => $this->generateUrl('admin_parametre_souscomposante_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousComposante);
            $em->flush();

            return $this->redirectToRoute('admin_parametre_souscomposante_index');

        }

        return $this->render('souscomposante/new.html.twig', array(
            'sousComposante' => $sousComposante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousComposante entity.
     *
     */
    public function showAction(Request $request, SousComposante $sousComposante)
    {
            $deleteForm = $this->createDeleteForm($sousComposante);
        $showForm = $this->createForm('PPCA\ParametreBundle\Form\SousComposanteType', $sousComposante);
    $showForm->handleRequest($request);


    return $this->render('souscomposante/show.html.twig', array(
            'sousComposante' => $sousComposante,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing sousComposante entity.
     *
     */
    public function editAction(Request $request, SousComposante $sousComposante)
    {
        $deleteForm = $this->createDeleteForm($sousComposante);
        $editForm = $this->createForm('PPCA\ParametreBundle\Form\SousComposanteType', $sousComposante, array(
                'action' => $this->generateUrl('admin_parametre_souscomposante_edit', array('id' => $sousComposante->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_parametre_souscomposante_index');
        }

        return $this->render('souscomposante/edit.html.twig', array(
            'sousComposante' => $sousComposante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sousComposante entity.
     *
     */
    public function deleteAction(Request $request, SousComposante $sousComposante)
    {
        $form = $this->createDeleteForm($sousComposante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousComposante);
            $em->flush();
        }

        return $this->redirectToRoute('admin_parametre_souscomposante_index');
    }

    /**
     * Creates a form to delete a sousComposante entity.
     *
     * @param SousComposante $sousComposante The sousComposante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SousComposante $sousComposante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_parametre_souscomposante_delete', array('id' => $sousComposante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
