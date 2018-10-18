<?php

namespace PPCA\SiseBundle\Entity;

/**
 * PieceJointeMail
 */
class PieceJointeMail
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \stdClass
     */
    private $mail;

    /**
     * @var string
     */
    private $urlFichier;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mail
     *
     * @param \stdClass $mail
     *
     * @return PieceJointeMail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return \stdClass
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set urlFichier
     *
     * @param string $urlFichier
     *
     * @return PieceJointeMail
     */
    public function setUrlFichier($urlFichier)
    {
        $this->urlFichier = $urlFichier;

        return $this;
    }

    /**
     * Get urlFichier
     *
     * @return string
     */
    public function getUrlFichier()
    {
        return $this->urlFichier;
    }
}

