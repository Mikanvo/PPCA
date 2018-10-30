<?php

namespace PPCA\ParametreBundle\Controller;

use PPCA\ParametreBundle\Entity\Bailleur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Bailleur controller.
 *
 */
class BailleurController extends Controller
{
    /**
     * Lists all bailleur entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('ParametreBundle:Bailleur');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_parametre_bailleur_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Bailleur:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_parametre_bailleur_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'ParametreBundle:Bailleur:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('bailleur/index.html.twig');
    }

    /**
     * Creates a new bailleur entity.
     *
     */
    public function newAction(Request $request)
    {
        $bailleur = new Bailleur();
        $form = $this->createForm('PPCA\ParametreBundle\Form\BailleurType', $bailleur, array(
                'action' => $this->generateUrl('admin_parametre_bailleur_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bailleur);
            $em->flush();

            return $this->redirectToRoute('admin_parametre_bailleur_index');

        }

        return $this->render('bailleur/new.html.twig', array(
            'bailleur' => $bailleur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bailleur entity.
     *
     */
    public function showAction(Request $request, Bailleur $bailleur)
    {
            $deleteForm = $this->createDeleteForm($bailleur);
        $showForm = $this->createForm('PPCA\ParametreBundle\Form\BailleurType', $bailleur);
    $showForm->handleRequest($request);


    return $this->render('bailleur/show.html.twig', array(
            'bailleur' => $bailleur,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing bailleur entity.
     *
     */
    public function editAction(Request $request, Bailleur $bailleur)
    {
        $deleteForm = $this->createDeleteForm($bailleur);
        $editForm = $this->createForm('PPCA\ParametreBundle\Form\BailleurType', $bailleur, array(
                'action' => $this->generateUrl('admin_parametre_bailleur_edit', array('id' => $bailleur->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_parametre_bailleur_index');
        }

        return $this->render('bailleur/edit.html.twig', array(
            'bailleur' => $bailleur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bailleur entity.
     *
     */
    public function deleteAction(Request $request, Bailleur $bailleur)
    {
        $form = $this->createDeleteForm($bailleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bailleur);
            $em->flush();
        }

        return $this->redirectToRoute('admin_parametre_bailleur_index');
    }

    /**
     * Creates a form to delete a bailleur entity.
     *
     * @param Bailleur $bailleur The bailleur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bailleur $bailleur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_parametre_bailleur_delete', array('id' => $bailleur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
