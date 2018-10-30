<?php

namespace PPCA\ParametreBundle\Controller;

use PPCA\ParametreBundle\Entity\Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Activite controller.
 *
 */
class ActiviteController extends Controller
{
    /**
     * Lists all activite entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('ParametreBundle:Activite');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_parametre_activite_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Activite:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_parametre_activite_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Activite:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('activite/index.html.twig');
    }

    /**
     * Creates a new activite entity.
     *
     */
    public function newAction(Request $request)
    {
        $activite = new Activite();
        $form = $this->createForm('PPCA\ParametreBundle\Form\ActiviteType', $activite, array(
                'action' => $this->generateUrl('admin_parametre_activite_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activite);
            $em->flush();

            return $this->redirectToRoute('admin_parametre_activite_index');

        }

        return $this->render('activite/new.html.twig', array(
            'activite' => $activite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a activite entity.
     *
     */
    public function showAction(Request $request, Activite $activite)
    {
            $deleteForm = $this->createDeleteForm($activite);
        $showForm = $this->createForm('PPCA\ParametreBundle\Form\ActiviteType', $activite);
    $showForm->handleRequest($request);


    return $this->render('activite/show.html.twig', array(
            'activite' => $activite,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing activite entity.
     *
     */
    public function editAction(Request $request, Activite $activite)
    {
        $deleteForm = $this->createDeleteForm($activite);
        $editForm = $this->createForm('PPCA\ParametreBundle\Form\ActiviteType', $activite, array(
                'action' => $this->generateUrl('admin_parametre_activite_edit', array('id' => $activite->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_parametre_activite_index');
        }

        return $this->render('activite/edit.html.twig', array(
            'activite' => $activite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a activite entity.
     *
     */
    public function deleteAction(Request $request, Activite $activite)
    {
        $form = $this->createDeleteForm($activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activite);
            $em->flush();
        }

        return $this->redirectToRoute('admin_parametre_activite_index');
    }

    /**
     * Creates a form to delete a activite entity.
     *
     * @param Activite $activite The activite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Activite $activite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_parametre_activite_delete', array('id' => $activite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
