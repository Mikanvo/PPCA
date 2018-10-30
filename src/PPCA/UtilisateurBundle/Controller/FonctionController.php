<?php

namespace PPCA\UtilisateurBundle\Controller;

use PPCA\UtilisateurBundle\Entity\Fonction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;


/**
 * Fonction controller.
 *
 */
class FonctionController extends Controller
{
    /**
     * Lists all fonction entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('UtilisateurBundle:Fonction');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_utilisateur_etat_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'UtilisateurBundle:Fonction:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_utilisateur_etat_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'UtilisateurBundle:Fonction:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('fonction/index.html.twig');
    }

    /**
     * Creates a new fonction entity.
     *
     */
    public function newAction(Request $request)
    {
        $fonction = new Fonction();
        $form = $this->createForm('PPCA\UtilisateurBundle\Form\FonctionType', $fonction, array(
                'action' => $this->generateUrl('admin_utilisateur_etat_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fonction);
            $em->flush();

            return $this->redirectToRoute('admin_utilisateur_etat_index');

        }

        return $this->render('fonction/new.html.twig', array(
            'fonction' => $fonction,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fonction entity.
     *
     */
    public function showAction(Request $request, Fonction $fonction)
    {
            $deleteForm = $this->createDeleteForm($fonction);
        $showForm = $this->createForm('PPCA\UtilisateurBundle\Form\FonctionType', $fonction);
    $showForm->handleRequest($request);


    return $this->render('fonction/show.html.twig', array(
            'fonction' => $fonction,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing fonction entity.
     *
     */
    public function editAction(Request $request, Fonction $fonction)
    {
        $deleteForm = $this->createDeleteForm($fonction);
        $editForm = $this->createForm('PPCA\UtilisateurBundle\Form\FonctionType', $fonction, array(
                'action' => $this->generateUrl('admin_utilisateur_etat_edit'),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_utilisateur_etat_edit', array('id' => $fonction->getId()));
        }

        return $this->render('fonction/edit.html.twig', array(
            'fonction' => $fonction,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fonction entity.
     *
     */
    public function deleteAction(Request $request, Fonction $fonction)
    {
        $form = $this->createDeleteForm($fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fonction);
            $em->flush();
        }

        return $this->redirectToRoute('admin_utilisateur_etat_index');
    }

    /**
     * Creates a form to delete a fonction entity.
     *
     * @param Fonction $fonction The fonction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fonction $fonction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_utilisateur_etat_delete', array('id' => $fonction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
