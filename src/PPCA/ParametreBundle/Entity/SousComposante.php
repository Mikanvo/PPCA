<?php

namespace PPCA\ParametreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousComposante
 *
 * @ORM\Table(name="sous_composante")
 * @ORM\Entity(repositoryClass="PPCA\ParametreBundle\Repository\SousComposanteRepository")
 */
class SousComposante
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
     * @ORM\Column(name="composante", type="object")
     */
    private $composante;


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
     * @param \stdClass $composante
     *
     * @return SousComposante
     */
    public function setComposante($composante)
    {
        $this->composante = $composante;

        return $this;
    }

    /**
     * Get composante
     *
     * @return \stdClass
     */
    public function getComposante()
    {
        return $this->composante;
    }
}

