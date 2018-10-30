<?php

namespace PPCA\SiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * PieceJointeMailDano
 *
 * @ORM\Table(name="piece_jointe_mail_dano")
 * @ORM\Entity(repositoryClass="PPCA\SiseBundle\Repository\PieceJointeMailDanoRepository")
 */
class PieceJointeMailDano
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Mail")
     * @GRID\Column(field="mail.objet", title="Mail")
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="urlfichier", type="string", length=255)
     */
    private $urlfichier;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set urlfichier
     *
     * @param string $urlfichier
     *
     * @return PieceJointeMailDano
     */
    public function setUrlfichier($urlfichier)
    {
        $this->urlfichier = $urlfichier;

        return $this;
    }

    /**
     * Get urlfichier
     *
     * @return string
     */
    public function getUrlfichier()
    {
        return $this->urlfichier;
    }

    /**
     * Set mail
     *
     * @param \PPCA\SiseBundle\Entity\Mail $mail
     *
     * @return PieceJointeMailDano
     */
    public function setMail(\PPCA\SiseBundle\Entity\Mail $mail = null)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return \PPCA\SiseBundle\Entity\Mail
     */
    public function getMail()
    {
        return $this->mail;
    }
}
