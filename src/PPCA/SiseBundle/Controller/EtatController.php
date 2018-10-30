<?php

namespace PPCA\SiseBundle\Controller;

use PPCA\SiseBundle\Entity\Etat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Etat controller.
 *
 */
class EtatController extends Controller
{
    /**
     * Lists all etat entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('SiseBundle:Etat');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_sise_etat_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Etat:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_sise_etat_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Etat:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('etat/index.html.twig');
    }

    /**
     * Creates a new etat entity.
     *
     */
    public function newAction(Request $request)
    {
        $etat = new Etat();
        $form = $this->createForm('PPCA\SiseBundle\Form\EtatType', $etat, array(
                'action' => $this->generateUrl('admin_sise_etat_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etat);
            $em->flush();

            return $this->redirectToRoute('admin_sise_etat_index');

        }

        return $this->render('etat/new.html.twig', array(
            'etat' => $etat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etat entity.
     *
     */
    public function showAction(Request $request, Etat $etat)
    {
            $deleteForm = $this->createDeleteForm($etat);
        $showForm = $this->createForm('PPCA\SiseBundle\Form\EtatType', $etat);
    $showForm->handleRequest($request);


    return $this->render('etat/show.html.twig', array(
            'etat' => $etat,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing etat entity.
     *
     */
    public function editAction(Request $request, Etat $etat)
    {
        $deleteForm = $this->createDeleteForm($etat);
        $editForm = $this->createForm('PPCA\SiseBundle\Form\EtatType', $etat, array(
                'action' => $this->generateUrl('admin_sise_etat_edit', array('id' => $etat->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sise_etat_index');
        }

        return $this->render('etat/edit.html.twig', array(
            'etat' => $etat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etat entity.
     *
     */
    public function deleteAction(Request $request, Etat $etat)
    {
        $form = $this->createDeleteForm($etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etat);
            $em->flush();
        }

        return $this->redirectToRoute('admin_sise_etat_index');
    }

    /**
     * Creates a form to delete a etat entity.
     *
     * @param Etat $etat The etat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etat $etat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sise_etat_delete', array('id' => $etat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
