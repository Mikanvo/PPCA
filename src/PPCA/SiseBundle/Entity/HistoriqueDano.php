<?php

namespace PPCA\SiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * HistoriqueDano
 *
 * @ORM\Table(name="historique_dano")
 * @ORM\Entity(repositoryClass="PPCA\SiseBundle\Repository\HistoriqueDanoRepository")
 */
class HistoriqueDano
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
     * @ORM\ManyToOne(targetEntity="Dano")
     * @GRID\Column(field="dano.objet", title="Dano")
     */
    private $dano;

    /**
     * @ORM\ManyToOne(targetEntity="Etat")
     * @GRID\Column(field="etat.libelle", title="Etat")
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;




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

    /**
     * Set dano
     *
     * @param \PPCA\SiseBundle\Entity\Dano $dano
     *
     * @return HistoriqueDano
     */
    public function setDano(\PPCA\SiseBundle\Entity\Dano $dano = null)
    {
        $this->dano = $dano;

        return $this;
    }

    /**
     * Get dano
     *
     * @return \PPCA\SiseBundle\Entity\Dano
     */
    public function getDano()
    {
        return $this->dano;
    }

    /**
     * Set etat
     *
     * @param \PPCA\SiseBundle\Entity\Etat $etat
     *
     * @return HistoriqueDano
     */
    public function setEtat(\PPCA\SiseBundle\Entity\Etat $etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \PPCA\SiseBundle\Entity\Etat
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
