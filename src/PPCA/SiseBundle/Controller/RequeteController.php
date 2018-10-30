<?php

namespace PPCA\SiseBundle\Controller;

use PPCA\SiseBundle\Entity\Requete;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Requete controller.
 *
 */
class RequeteController extends Controller
{
    /**
     * Lists all requete entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('SiseBundle:Requete');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_sise_requete_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Requete:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_sise_requete_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Requete:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('requete/index.html.twig');
    }

    /**
     * Creates a new requete entity.
     *
     */
    public function newAction(Request $request)
    {
        $requete = new Requete();
        $form = $this->createForm('PPCA\SiseBundle\Form\RequeteType', $requete, array(
                'action' => $this->generateUrl('admin_sise_requete_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requete);
            $em->flush();

            return $this->redirectToRoute('admin_sise_requete_index');

        }

        return $this->render('requete/new.html.twig', array(
            'requete' => $requete,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a requete entity.
     *
     */
    public function showAction(Request $request, Requete $requete)
    {
            $deleteForm = $this->createDeleteForm($requete);
        $showForm = $this->createForm('PPCA\SiseBundle\Form\RequeteType', $requete);
    $showForm->handleRequest($request);


    return $this->render('requete/show.html.twig', array(
            'requete' => $requete,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing requete entity.
     *
     */
    public function editAction(Request $request, Requete $requete)
    {
        $deleteForm = $this->createDeleteForm($requete);
        $editForm = $this->createForm('PPCA\SiseBundle\Form\RequeteType', $requete, array(
                'action' => $this->generateUrl('admin_sise_requete_edit', array('id' => $requete->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sise_requete_index');
        }

        return $this->render('requete/edit.html.twig', array(
            'requete' => $requete,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a requete entity.
     *
     */
    public function deleteAction(Request $request, Requete $requete)
    {
        $form = $this->createDeleteForm($requete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($requete);
            $em->flush();
        }

        return $this->redirectToRoute('admin_sise_requete_index');
    }

    /**
     * Creates a form to delete a requete entity.
     *
     * @param Requete $requete The requete entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Requete $requete)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sise_requete_delete', array('id' => $requete->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
