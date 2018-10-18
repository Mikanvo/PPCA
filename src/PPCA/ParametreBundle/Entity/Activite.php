<?php

namespace PPCA\ParametreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="PPCA\ParametreBundle\Repository\ActiviteRepository")
 */
class Activite
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=50)
     */
    private $libelle;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="souscomposante", type="object")
     */
    private $souscomposante;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Activite
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set souscomposante
     *
     * @param \stdClass $souscomposante
     *
     * @return Activite
     */
    public function setSouscomposante($souscomposante)
    {
        $this->souscomposante = $souscomposante;

        return $this;
    }

    /**
     * Get souscomposante
     *
     * @return \stdClass
     */
    public function getSouscomposante()
    {
        return $this->souscomposante;
    }
}

