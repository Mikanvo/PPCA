<?php

namespace PPCA\SiseBundle\Controller;

use PPCA\SiseBundle\Entity\Dano;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Dano controller.
 *
 */
class DanoController extends Controller
{
    /**
     * Lists all dano entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('SiseBundle:Dano');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_sise_dano_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Dano:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_sise_dano_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Dano:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('dano/index.html.twig');
    }

    /**
     * Creates a new dano entity.
     *
     */
    public function newAction(Request $request)
    {
        $dano = new Dano();
        $form = $this->createForm('PPCA\SiseBundle\Form\DanoType', $dano, array(
                'action' => $this->generateUrl('admin_sise_dano_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dano);
            $em->flush();

            return $this->redirectToRoute('admin_sise_dano_index');

        }

        return $this->render('dano/new.html.twig', array(
            'dano' => $dano,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a dano entity.
     *
     */
    public function showAction(Request $request, Dano $dano)
    {
            $deleteForm = $this->createDeleteForm($dano);
        $showForm = $this->createForm('PPCA\SiseBundle\Form\DanoType', $dano);
    $showForm->handleRequest($request);


    return $this->render('dano/show.html.twig', array(
            'dano' => $dano,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing dano entity.
     *
     */
    public function editAction(Request $request, Dano $dano)
    {
        $deleteForm = $this->createDeleteForm($dano);
        $editForm = $this->createForm('PPCA\SiseBundle\Form\DanoType', $dano, array(
                'action' => $this->generateUrl('admin_sise_dano_edit', array('id' => $dano->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sise_dano_index');
        }

        return $this->render('dano/edit.html.twig', array(
            'dano' => $dano,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a dano entity.
     *
     */
    public function deleteAction(Request $request, Dano $dano)
    {
        $form = $this->createDeleteForm($dano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dano);
            $em->flush();
        }

        return $this->redirectToRoute('admin_sise_dano_index');
    }

    /**
     * Creates a form to delete a dano entity.
     *
     * @param Dano $dano The dano entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dano $dano)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sise_dano_delete', array('id' => $dano->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
