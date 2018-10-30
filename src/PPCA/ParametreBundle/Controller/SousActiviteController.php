<?php

namespace PPCA\ParametreBundle\Controller;

use PPCA\ParametreBundle\Entity\SousActivite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Sousactivite controller.
 *
 */
class SousActiviteController extends Controller
{
    /**
     * Lists all sousActivite entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('ParametreBundle:SousActivite');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_parametre_sousactivite_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:SousActivite:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_parametre_sousactivite_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:SousActivite:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('sousactivite/index.html.twig');
    }

    /**
     * Creates a new sousActivite entity.
     *
     */
    public function newAction(Request $request)
    {
        $sousActivite = new Sousactivite();
        $form = $this->createForm('PPCA\ParametreBundle\Form\SousActiviteType', $sousActivite, array(
                'action' => $this->generateUrl('admin_parametre_sousactivite_new', array('id' => $sousActivite->getId())),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousActivite);
            $em->flush();

            return $this->redirectToRoute('admin_parametre_sousactivite_index', array('id' => $sousActivite->getId()));

        }

        return $this->render('sousactivite/new.html.twig', array(
            'sousActivite' => $sousActivite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousActivite entity.
     *
     */
    public function showAction(Request $request, SousActivite $sousActivite)
    {
            $deleteForm = $this->createDeleteForm($sousActivite);
        $showForm = $this->createForm('PPCA\ParametreBundle\Form\SousActiviteType', $sousActivite);
    $showForm->handleRequest($request);


    return $this->render('sousactivite/show.html.twig', array(
            'sousActivite' => $sousActivite,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing sousActivite entity.
     *
     */
    public function editAction(Request $request, SousActivite $sousActivite)
    {
        $deleteForm = $this->createDeleteForm($sousActivite);
        $editForm = $this->createForm('PPCA\ParametreBundle\Form\SousActiviteType', $sousActivite, array(
                'action' => $this->generateUrl('admin_parametre_sousactivite_edit', array('id' => $sousActivite->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_parametre_sousactivite_index');
        }

        return $this->render('sousactivite/edit.html.twig', array(
            'sousActivite' => $sousActivite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sousActivite entity.
     *
     */
    public function deleteAction(Request $request, SousActivite $sousActivite)
    {
        $form = $this->createDeleteForm($sousActivite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousActivite);
            $em->flush();
        }

        return $this->redirectToRoute('admin_parametre_sousactivite_index');
    }

    /**
     * Creates a form to delete a sousActivite entity.
     *
     * @param SousActivite $sousActivite The sousActivite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SousActivite $sousActivite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_parametre_sousactivite_delete', array('id' => $sousActivite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
