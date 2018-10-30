<?php

namespace PPCA\UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @ORM\Entity
 * @GRID\Source(columns="id, matricule, nom, prenom, fonction.libelle, laboratoire.sigle")
 */
class Employe
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @GRID\Column(visible=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */
    private $matricule;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @ORM\OneToOne(targetEntity="PPCA\ParametreBundle\Entity\Image", cascade={"persist","remove"})
     */    
    private $photo;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $datenaissance;

	/**
     * @ORM\ManyToOne(targetEntity="Fonction")
     * @Assert\NotBlank()
     * @GRID\Column(field="fonction.libelle", title="Fonction")
     */    
    private $fonction;

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
     * Set matricule
     *
     * @param string $matricule
     * @return Employe
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string 
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Employe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Employe
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return Employe
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }


    /**
     * Set fonction
     *
     * @param \PPCA\UtilisateurBundle\Entity\Fonction $fonction
     * @return Employe
     */
    public function setFonction(\PPCA\UtilisateurBundle\Entity\Fonction $fonction = null)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return \PPCA\UtilisateurBundle\Entity\Fonction
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set photo
     *
     * @param \PPCA\ParametreBundle\Entity\Image $photo
     * @return Employe
     */
    public function setPhoto(\PPCA\ParametreBundle\Entity\Image $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return integer 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Get nomComplet
     *
     * @return string
     */
    public function getNomComplet()
    {
        return $this->nom.' '.$this->prenom;
    }


}
