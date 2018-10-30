<?php

namespace PPCA\SiseBundle\Controller;

use PPCA\SiseBundle\Entity\PieceJointeDano;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Piecejointedano controller.
 *
 */
class PieceJointeDanoController extends Controller
{
    /**
     * Lists all pieceJointeDano entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('SiseBundle:PieceJointeDano');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_sise_piecejointedano_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:PieceJointeDano:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_sise_piecejointedano_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:PieceJointeDano:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('piecejointedano/index.html.twig');
    }

    /**
     * Creates a new pieceJointeDano entity.
     *
     */
    public function newAction(Request $request)
    {
        $pieceJointeDano = new Piecejointedano();
        $form = $this->createForm('PPCA\SiseBundle\Form\PieceJointeDanoType', $pieceJointeDano, array(
                'action' => $this->generateUrl('admin_sise_piecejointedano_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pieceJointeDano);
            $em->flush();

            return $this->redirectToRoute('admin_sise_piecejointedano_index');

        }

        return $this->render('piecejointedano/new.html.twig', array(
            'pieceJointeDano' => $pieceJointeDano,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pieceJointeDano entity.
     *
     */
    public function showAction(Request $request, PieceJointeDano $pieceJointeDano)
    {
            $deleteForm = $this->createDeleteForm($pieceJointeDano);
        $showForm = $this->createForm('PPCA\SiseBundle\Form\PieceJointeDanoType', $pieceJointeDano);
    $showForm->handleRequest($request);


    return $this->render('piecejointedano/show.html.twig', array(
            'pieceJointeDano' => $pieceJointeDano,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing pieceJointeDano entity.
     *
     */
    public function editAction(Request $request, PieceJointeDano $pieceJointeDano)
    {
        $deleteForm = $this->createDeleteForm($pieceJointeDano);
        $editForm = $this->createForm('PPCA\SiseBundle\Form\PieceJointeDanoType', $pieceJointeDano, array(
                'action' => $this->generateUrl('admin_sise_piecejointedano_edit', array('id' => $pieceJointeDano->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sise_piecejointedano_index', array('id' => $pieceJointeDano->getId()));
        }

        return $this->render('piecejointedano/edit.html.twig', array(
            'pieceJointeDano' => $pieceJointeDano,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pieceJointeDano entity.
     *
     */
    public function deleteAction(Request $request, PieceJointeDano $pieceJointeDano)
    {
        $form = $this->createDeleteForm($pieceJointeDano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pieceJointeDano);
            $em->flush();
        }

        return $this->redirectToRoute('admin_sise_piecejointedano_index');
    }

    /**
     * Creates a form to delete a pieceJointeDano entity.
     *
     * @param PieceJointeDano $pieceJointeDano The pieceJointeDano entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PieceJointeDano $pieceJointeDano)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sise_piecejointedano_delete', array('id' => $pieceJointeDano->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
