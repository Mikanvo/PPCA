<?php

namespace PPCA\SiseBundle\Controller;

use PPCA\SiseBundle\Entity\Mail;
use PPCA\SiseBundle\Entity\Etat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\RowAction;



/**
 * Mail controller.
 *
 */
class MailController extends Controller
{
    /**
     * Lists all mail entities.
     *
     */
    public function indexAction(Request $request)
    {

        $source = new Entity('SiseBundle:Mail');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Détails', 'admin_sise_mail_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Mail:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        $rowAction = new RowAction('Modifier', 'admin_sise_mail_edit');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Mail:edit', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);



        return $grid->getGridResponse('mail/index.html.twig');
        
    }

    /**
     * Lists all mail entities.
     *
     */
    public function bailleurAction(Request $request)
    {

        $source = new Entity('SiseBundle:Mail');

        $grid = $this->get('grid');

        $grid->setSource($source);


        $rowAction = new RowAction('Aperçu', 'admin_sise_mail_show');
        $rowAction->addManipulateRender(function ($action, $row)  {
            return ['controller' => 'SiseBundle:Mail:show', 'parameters' => ['id' => $row->getField('id')]];
        });
        $grid->addRowAction($rowAction);

        return $grid->getGridResponse('mail/bailleur.html.twig');
    }

    /**
     * Lists all affection entities.
     *
     */
    public function listeAction(Request $request, $etat = 1)
    {
        $em = $this->getDoctrine()->getManager();

        $listes_mail = $em->getRepository('SiseBundle:Mail')->findAll();

        $mails  = $this->get('knp_paginator')->paginate(
            $listes_mail,
            $request->query->get('page', 1)/*page number*/,
            1000/*limit per page*/
        );


        return $this->render('mail/liste.html.twig', array(
            'mails' => $mails,
            'etat'  => $etat,
        ));
    }

    /**
     * Creates a new mail entity.
     *
     */
    public function newAction(Request $request)
    {
        $mail = new Mail();
        $form = $this->createForm('PPCA\SiseBundle\Form\MailType', $mail, array(
                'action' => $this->generateUrl('admin_sise_mail_new'),
                'method' => 'POST',
            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();

            return $this->redirectToRoute('admin_sise_mail_index');

        }

        return $this->render('mail/new.html.twig', array(
            'mail' => $mail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mail entity.
     *
     */
    public function showAction(Request $request, Mail $mail)
    {
        $deleteForm = $this->createDeleteForm($mail);
        $showForm = $this->createForm('PPCA\SiseBundle\Form\MailType', $mail);
        $showForm->handleRequest($request);


        return $this->render('mail/show.html.twig', array(
            'mail' => $mail,
            'show_form' => $showForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing mail entity.
     *
     */
    public function editAction(Request $request, Mail $mail)
    {
        $deleteForm = $this->createDeleteForm($mail);
        $editForm = $this->createForm('PPCA\SiseBundle\Form\MailType', $mail, array(
                'action' => $this->generateUrl('admin_sise_mail_edit', array('id' => $mail->getId())),
                'method' => 'POST',
            ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sise_mail_index');
        }

        return $this->render('mail/edit.html.twig', array(
            'mail' => $mail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function followAction(Request $request, Mail $mail)
    {
        $followForm = $this->createForm('PPCA\SiseBundle\Form\FollowType', array(
            'action' => $this->generateUrl('admin_sise_mail_follow', array('id' => $mail->getId())),
            'method' => 'POST',
        ));
        $followForm->handleRequest($request);

        if ($followForm->isSubmitted() && $followForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $mail->setDano($dano);
            $em->persist($mail);

            //Mise à jour de l'état de la dano
            $dano->setEtat($em->getRepository('SiseBundle:Etat')->find(1));
            $em->persist($dano);

            // Création de la ligne d'historique
            $historique = new HistoriqueDano();
            $historique->setEtat($em->getRepository('SiseBundle:Etat')->find());
            $historique->setDano($dano);

            $em->persist($historique);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_sise_mail_retour_bailleur');
        }

        return $this->render('mail/follow.html.twig', array(
            'mail' => $mail,
            'follow_form' => $followForm->createView(),
        ));

    }
    /**
     * Deletes a mail entity.
     *
     */
    public function deleteAction(Request $request, Mail $mail)
    {
        $form = $this->createDeleteForm($mail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mail);
            $em->flush();
        }

        return $this->redirectToRoute('admin_sise_mail_index');
    }

    /**
     * Creates a form to delete a mail entity.
     *
     * @param Mail $mail The mail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mail $mail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_sise_mail_delete', array('id' => $mail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
