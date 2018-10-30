<?php

namespace PPCA\ParametreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;


/**
 * SousActivite
 *
 * @ORM\Table(name="sous_activite")
 * @ORM\Entity(repositoryClass="PPCA\ParametreBundle\Repository\SousActiviteRepository")
 * @GRID\Source(columns="id, libelle, activite.libelle")
 */
class SousActivite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(name="id", title="ID", operatorsVisible=false, filterable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="libelle", type="string", length=50)
     */
    private $libelle;

    /**
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Activite")
     * @GRID\Column(field="activite.libelle", title="Activite")
     */
    private $activite;


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
     * @param \PPCA\ParametreBundle\Entity\Activite $activite
     *
     * @return SousActivite
     */
    public function setActivite(\PPCA\ParametreBundle\Entity\Activite $activite = null)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \PPCA\ParametreBundle\Entity\Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }
}
