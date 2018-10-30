<?php

namespace PPCA\UtilisateurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use PPCA\UtilisateurBundle\Entity\Groupe;
use PPCA\UtilisateurBundle\Form\GroupeType;

use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Export\CSVExport;
use APY\DataGridBundle\Grid\Export\ExcelExport;

use APY\DataGridBundle\Grid\Column\TextColumn;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;


/**
 * Groupe controller.
 *
 */
class GroupeController extends Controller
{

    /**
     * Lists all Groupe entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UtilisateurBundle:Groupe')->findAll();

        // Creates simple grid based on your entity (ORM)
        $source = new Entity('UtilisateurBundle:Groupe');

        // Get a grid instance
        $grid = $this->get('grid');

        // Attach the source to the grid
        $grid->setSource($source);

        //...
        $rowAction = new RowAction("Voir", 'groupe_show');
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction("Modifier", 'groupe_edit');
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction("Supprimer", 'groupe_delete', true, '_self');
        $rowAction->setConfirmMessage('Etes vous sur de vouloir supprimer ce groupe ?');
        $grid->addRowAction($rowAction);

        // Set the selector of the number of items per page
        $grid->setLimits(array(10, 15, 20));

        // Add a delete mass action
        $grid->addMassAction(new DeleteMassAction());

        //...
        //$grid->addExport(new PHPExcelPDFExport('Exporter au format PDF'));
        $grid->addExport(new CSVExport('Exporter au format CSV'));
        $grid->addExport(new ExcelExport('Exporter au format Excel'));
        //..

        // Manage the grid redirection, exports and the response of the controller
        return $grid->getGridResponse('UtilisateurBundle:Groupe:index.html.twig');

        //return $this->render('UtilisateurBundle:Groupe:index.html.twig', array('entities' => $entities,"grid" => $grid));
    }
/*    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UtilisateurBundle:Groupe')->findAll();

        return $this->render('UtilisateurBundle:Groupe:index.html.twig', array(
            'entities' => $entities
        ));
    }*/
    /**
     * Creates a new Groupe entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Groupe();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('groupe_show', array('id' => $entity->getId())));
        }

        return $this->render('UtilisateurBundle:Groupe:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Groupe entity.
     *
     * @param Groupe $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Groupe $entity)
    {
        $form = $this->createForm(new GroupeType(), $entity, array(
            'action' => $this->generateUrl('groupe_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new Groupe entity.
     *
     */
    public function newAction()
    {
        $entity = new Groupe();
        $form   = $this->createCreateForm($entity);

        return $this->render('UtilisateurBundle:Groupe:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Groupe entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UtilisateurBundle:Groupe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Groupe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UtilisateurBundle:Groupe:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Groupe entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UtilisateurBundle:Groupe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Groupe entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UtilisateurBundle:Groupe:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Groupe entity.
    *
    * @param Groupe $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Groupe $entity)
    {
        $form = $this->createForm(new GroupeType(), $entity, array(
            'action' => $this->generateUrl('groupe_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Groupe entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UtilisateurBundle:Groupe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Groupe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('groupe_edit', array('id' => $id)));
        }

        return $this->render('UtilisateurBundle:Groupe:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Groupe entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UtilisateurBundle:Groupe')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Groupe entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('groupe'));
    }

    /**
     * Creates a form to delete a Groupe entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groupe_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer'))
            ->getForm()
        ;
    }
}
