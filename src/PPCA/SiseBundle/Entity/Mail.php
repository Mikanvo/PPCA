<?php

namespace PPCA\SiseBundle\Entity;

/**
 * Mail
 */
class Mail
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $objet;

    /**
     * @var \stdClass
     */
    private $dano;

    /**
     * @var string
     */
    private $corps;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \stdClass
     */
    private $expediteur;


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
     * Set objet
     *
     * @param string $objet
     *
     * @return Mail
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set dano
     *
     * @param \stdClass $dano
     *
     * @return Mail
     */
    public function setDano($dano)
    {
        $this->dano = $dano;

        return $this;
    }

    /**
     * Get dano
     *
     * @return \stdClass
     */
    public function getDano()
    {
        return $this->dano;
    }

    /**
     * Set corps
     *
     * @param string $corps
     *
     * @return Mail
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Mail
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set expediteur
     *
     * @param \stdClass $expediteur
     *
     * @return Mail
     */
    public function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * Get expediteur
     *
     * @return \stdClass
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }
}

