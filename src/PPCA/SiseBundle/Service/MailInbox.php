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

        $mailIds =  $imap->searchMailbox('ALL'); //ALL
        $count = 0;
        foreach ($mailIds as $key => $id) {
            $mailObject = new Mail();
            $mail = $imap->getMail($mailIds[$key]);
            $data = [
                'corps' => $mail->textPlain ?? $mail->textHtml,
                'objet' => $mail->subject,
                'date' => $mail->date,
                'expediteur' => $mail->fromName . '(' . $mail->fromAddress . ')',
            ];

            foreach ($data as $field => $value) {
                if ($field == 'date') {
                    $value = new \DateTime($value);
                }
                $mailObject->{"set" . ucfirst($field)}($value);
            }

            $this->em->persist($mailObject);

            ++$count;
        }

        //dump($count);exit;

        if ($count) {
            $this->em->flush();
        }

        return $count;
    }
}
