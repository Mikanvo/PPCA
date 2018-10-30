<?php

namespace PPCA\ParametreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * SousComposante
 *
 * @ORM\Table(name="sous_composante")
 * @ORM\Entity(repositoryClass="PPCA\ParametreBundle\Repository\SousComposanteRepository")
 * @GRID\Source(columns="id, libelle, composante.libelle")
 */
class SousComposante
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
     * @ORM\ManyToOne(targetEntity="Composante")
     * @GRID\Column(field="composante.libelle", title="Composante")
     */
    private $composante;


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
     * @return SousComposante
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
     * Set composante
     *
     * @param \PPCA\ParametreBundle\Entity\Composante $composante
     *
     * @return SousComposante
     */
    public function setComposante(\PPCA\ParametreBundle\Entity\Composante $composante = null)
    {
        $this->composante = $composante;

        return $this;
    }

    /**
     * Get composante
     *
     * @return \PPCA\ParametreBundle\Entity\Composante
     */
    public function getComposante()
    {
        return $this->composante;
    }
}
