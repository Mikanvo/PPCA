<?php

namespace PPCA\UtilisateurBundle\Controller;

use PPCA\UtilisateurBundle\Entity\Employe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Employe controller.
 *
 */
class EmployeController extends Controller
{
    /**
     * Lists all employe entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('UtilisateurBundle:Employe');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_utilisateur_employe_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'UtilisateurBundle:Employe:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_utilisateur_employe_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'UtilisateurBundle:Employe:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('employe/index.html.twig');
    }

    /**
     * Creates a new employe entity.
     *
     */
    public function newAction(Request $request)
    {
        $employe = new Employe();
        $form = $this->createForm('PPCA\UtilisateurBundle\Form\EmployeType', $employe, array(
                'action' => $this->generateUrl('admin_utilisateur_employe_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('admin_utilisateur_employe_index');

        }

        return $this->render('employe/new.html.twig', array(
            'employe' => $employe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a employe entity.
     *
     */
    public function showAction(Request $request, Employe $employe)
    {
            $deleteForm = $this->createDeleteForm($employe);
        $showForm = $this->createForm('PPCA\UtilisateurBundle\Form\EmployeType', $employe);
    $showForm->handleRequest($request);


    return $this->render('employe/show.html.twig', array(
            'employe' => $employe,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing employe entity.
     *
     */
    public function editAction(Request $request, Employe $employe)
    {
        $deleteForm = $this->createDeleteForm($employe);
        $editForm = $this->createForm('PPCA\UtilisateurBundle\Form\EmployeType', $employe, array(
                'action' => $this->generateUrl('admin_utilisateur_employe_edit'),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_utilisateur_employe_edit', array('id' => $employe->getId()));
        }

        return $this->render('employe/edit.html.twig', array(
            'employe' => $employe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employe entity.
     *
     */
    public function deleteAction(Request $request, Employe $employe)
    {
        $form = $this->createDeleteForm($employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employe);
            $em->flush();
        }

        return $this->redirectToRoute('admin_utilisateur_employe_index');
    }

    /**
     * Creates a form to delete a employe entity.
     *
     * @param Employe $employe The employe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employe $employe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_utilisateur_employe_delete', array('id' => $employe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
