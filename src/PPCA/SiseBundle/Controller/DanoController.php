<?php

namespace PPCA\SiseBundle\Controller;

use PPCA\SiseBundle\Entity\Dano;
use PPCA\SiseBundle\Entity\HistoriqueDano;
use PPCA\SiseBundle\Entity\Etat;
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
     * Lists all affection entities.
     *
     */
    public function finaliseesAction(Request $request)
    {
        return $this->render('dano/finalisees.html.twig');
    }

    /**
     * Lists all affection entities.
     *
     */
    public function listeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $listes_dano = $em->getRepository('SiseBundle:Dano')->findAll();

        $danos  = $this->get('knp_paginator')->paginate(
            $listes_dano,
            $request->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return $this->render('dano/liste.html.twig', array(
            'danos' => $danos,
        ));
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

            //Mise à jour de l'état de la dano
            $dano->setEtat($em->getRepository('SiseBundle:Etat')->find(1));

            $em->persist($dano);

            // Création de la ligne d'historique
            $historique = new HistoriqueDano();
            $historique->setEtat($em->getRepository('SiseBundle:Etat')->find(1));
            $historique->setDano($dano);

            $em->persist($historique);

            // Validation des entités persistées
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

    /**
     * Sends a dano by mail.
     *
     */

    public function envoyerMailDanoAction(Request $request, Dano $dano)
    {
        $mailForm = $this->createForm('PPCA\SiseBundle\Form\DanoMailType', array(
            'action' => $this->generateUrl('admin_sise_dano_send_mail', array('id' => $dano->getId())),
            'method' => 'POST',
        ));
        $mailForm->handleRequest($request);

        if ($mailForm->isSubmitted() && $mailForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //Fonction denvoie de dano par mail
            $data = $mailForm->getData();

            $message = (new \Swift_Message($data['objet']))
                ->setFrom($data['email'], $data['nom'])
                ->setTo($data['destinataire'])
                ->setBody($data['message'], 'text/plain');

            if ($this->get('mailer')->send($message)) {

                // Création de la ligne d'historique
                $historique = new HistoriqueDano();
                $historique->setEtat(2);
                $historique->setDano($dano->getId());

                // On récupère l'EntityManager
                $em = $this->getDoctrine()->getManager();

                // Étape 1 : On « persiste » l'entité
                $em->persist($historique);

                // Étape 2 : On « flush » tout ce qui a été persisté avant
                $em->flush();

                //Flash pour mail envoyé
                $this->addFlash('success', 'Votre mail a été envoyé. Nous vous repondrons dans les plus brefs délais!');

            } else {
                //Flash pour mail non envoyé
                $this->addFlash('warning', 'Votre mail n\'a pas été envoyé. Merci réessayer!');
            }

            return $this->redirectToRoute('admin_sise_dano_index');
        }

        return $this->render('dano/mail.html.twig', array(
            'dano' => $dano,
            'mail_form' => $mailForm->createView(),
        ));
    }
}
