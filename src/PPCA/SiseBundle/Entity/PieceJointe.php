<?php

namespace PPCA\SiseBundle\Entity;

/**
 * PieceJointe
 */
class PieceJointe
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \stdClass
     */
    private $dano;

    /**
     * @var \stdClass
     */
    private $etat;

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
     * Set dano
     *
     * @param \stdClass $dano
     *
     * @return PieceJointe
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
     * Set etat
     *
     * @param \stdClass $etat
     *
     * @return PieceJointe
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \stdClass
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set urlFichier
     *
     * @param string $urlFichier
     *
     * @return PieceJointe
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

