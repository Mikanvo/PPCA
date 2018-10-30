<?php

namespace PPCA\SiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * PieceJointeDano
 *
 * @ORM\Table(name="piece_jointe_dano")
 * @ORM\Entity(repositoryClass="PPCA\SiseBundle\Repository\PieceJointeDanoRepository")
 */
class PieceJointeDano
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
     * @ORM\ManyToOne(targetEntity="Dano", inversedBy="piecejointe")
     * @GRID\Column(field="dano.numero", title="Dano")
     */
    private $dano;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $urlfichier;

    /**
     * @ORM\ManyToOne(targetEntity="Etat")
     * @GRID\Column(field="etat.libelle", title="Etat")
     */
    private $etat;

    private $file;

    private $webPath;

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;


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
     * Set urlfichier
     *
     * @param string $urlfichier
     *
     * @return PieceJointeDano
     */
    public function setUrlfichier($urlfichier)
    {
        $this->urlfichier = $urlfichier;

        return $this;
    }

    /**
     * Get urlfichier
     *
     * @return string
     */
    public function getUrlfichier()
    {
        return $this->urlfichier;
    }

    /**
     * Set dano
     *
     * @param \PPCA\SiseBundle\Entity\Dano $dano
     *
     * @return PieceJointeDano
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
     * @return PieceJointeDano
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
