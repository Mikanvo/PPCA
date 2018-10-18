<?php

namespace PPCA\SiseBundle\Entity;

/**
 * HistoriqueDano
 */
class HistoriqueDano
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
     * @var \DateTime
     */
    private $date;


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
     * @return HistoriqueDano
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
     * @return HistoriqueDano
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return HistoriqueDano
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
}

