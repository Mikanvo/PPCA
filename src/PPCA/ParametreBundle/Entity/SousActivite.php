<?php

namespace PPCA\ParametreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousActivite
 *
 * @ORM\Table(name="sous_activite")
 * @ORM\Entity(repositoryClass="PPCA\ParametreBundle\Repository\SousActiviteRepository")
 */
class SousActivite
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
     * @ORM\Column(name="activite", type="object")
     */
    private $activite;


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
     * @return SousActivite
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
     * Set activite
     *
     * @param \stdClass $activite
     *
     * @return SousActivite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \stdClass
     */
    public function getActivite()
    {
        return $this->activite;
    }
}

