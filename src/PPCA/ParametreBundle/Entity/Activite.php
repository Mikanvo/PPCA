<?php

namespace PPCA\ParametreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;


/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="PPCA\ParametreBundle\Repository\ActiviteRepository")
 * @GRID\Source(columns="id, code, libelle, souscomposante.code")
 */
class Activite
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="code", type="string", length=10)
     * @GRID\Column(name="code", title="code")
     */
    private $code;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="SousComposante")
     * @GRID\Column(field="souscomposante.libelle", title="Sous Composante")
     */
    private $souscomposante;



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
     * @param \PPCA\ParametreBundle\Entity\SousComposante $souscomposante
     *
     * @return Activite
     */
    public function setSouscomposante(\PPCA\ParametreBundle\Entity\SousComposante $souscomposante = null)
    {
        $this->souscomposante = $souscomposante;

        return $this;
    }

    /**
     * Get souscomposante
     *
     * @return \PPCA\ParametreBundle\Entity\SousComposante
     */
    public function getSouscomposante()
    {
        return $this->souscomposante;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Activite
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
