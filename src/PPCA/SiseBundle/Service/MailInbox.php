<?php

namespace PPCA\SiseBundle\Service;
use SecIT\ImapBundle\Service\Imap;
use Doctrine\ORM\EntityManager;

use PPCA\SiseBundle\Entity\Mail;


class MailInbox
{
    /**
     * @var mixed
     */
    private $em;

    private $imap;


    /**
     * @param EntityManager $em
     * @param Imap $imap
     */
    public function __construct(EntityManager $em, Imap $imap)
    {
        $this->em = $em;
        $this->imap = $imap;
    }

    

    public function processInsert()
    {
        $imap = $this->imap->get('example_connection');

        $mailIds =  $imap->searchMailbox('UNSEEN');
        $count = 0;
        foreach ($mailIds as $key => $id) {
            $mailObject = new Mail();
            $mail = $imap->getMail($mailIds[$key]);
            $mailObject->setCorps($mail->textPlain ?? $mail->textHtml);
            $mailObject->setObjet($mail->subject);
            $mailObject->setDate(new \DateTime($mail->date));
            $mailObject->setExpediteur($mail->fromAddress);
            $this->em->persist($mailObject);

            ++$count;
        }

        if ($count) {
            $this->em->flush();
        }

        return $count;
    }
}
