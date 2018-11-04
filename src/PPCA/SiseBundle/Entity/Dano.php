<?php

namespace PPCA\SiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Dano
 *
 * @ORM\Table(name="dano")
 * @ORM\Entity(repositoryClass="PPCA\SiseBundle\Repository\DanoRepository")
 * @GRID\Source(columns="id, numero, objet, requete.libelle, activite.libelle")
 */
class Dano
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(name="id", title="ID", operatorsVisible=false, filterable=false, visible=false)
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="numero", type="string", length=10, unique=true)
     * @GRID\Column(field="destinataire.libelle", title="Numéro", size="10")
     */
    private $numero;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="objet", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $objet;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="corps", type="text")
     * @Assert\NotBlank()
     */
    private $corps;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="observation", type="text")
     */
    private $observation;

    /**
     * @ORM\ManyToOne(targetEntity="Requete")
     * @GRID\Column(field="requete.libelle", title="Requete")
     * @Assert\NotBlank()
     */
    private $requete;

    /**
     * @ORM\ManyToOne(targetEntity="PPCA\ParametreBundle\Entity\Bailleur")
     * @GRID\Column(field="destinataire.libelle", title="Bailleur")
     * @Assert\NotBlank()
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity="PPCA\ParametreBundle\Entity\Activite")
     * @GRID\Column(field="activite.libelle", title="Activite")
     * @Assert\NotBlank()
     */
    private $activite;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficiaire", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $beneficiaire;

    /**
     * @var string
     *
     * @ORM\Column(name="observationPTBA", type="string", length=255)
     */
    private $observationPTBA;

    /**
     * @var string
     *
     * @ORM\Column(name="observationPPM", type="string", length=255)
     */
    private $observationPPM;

    /********** Champs rajoutés **********/

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datereception", type="datetime")
     *
     */
    private $datereception;

    /**
     * @ORM\OneToMany(targetEntity="PieceJointeDano", mappedBy="dano", cascade={"persist"}, orphanRemoval=true)
     */
    private $piecejointe;

    /**
     * @ORM\OneToMany(targetEntity="HistoriqueDano", mappedBy="dano", cascade={"persist"})
     */
    private $etape;

    /**
     * @ORM\ManyToOne(targetEntity="Etat")
     * @GRID\Column(field="etat.libelle", title="Etat")
     * @Assert\NotBlank()
     */
    private $etat;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->piecejointe = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set numero
     *
     * @param string $numero
     *
     * @return Dano
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return Dano
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set corps
     *
     * @param string $corps
     *
     * @return Dano
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Dano
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return Dano
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set beneficiaire
     *
     * @param string $beneficiaire
     *
     * @return Dano
     */
    public function setBeneficiaire($beneficiaire)
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    /**
     * Get beneficiaire
     *
     * @return string
     */
    public function getBeneficiaire()
    {
        return $this->beneficiaire;
    }

    /**
     * Set observationPTBA
     *
     * @param string $observationPTBA
     *
     * @return Dano
     */
    public function setObservationPTBA($observationPTBA)
    {
        $this->observationPTBA = $observationPTBA;

        return $this;
    }

    /**
     * Get observationPTBA
     *
     * @return string
     */
    public function getObservationPTBA()
    {
        return $this->observationPTBA;
    }

    /**
     * Set observationPPM
     *
     * @param string $observationPPM
     *
     * @return Dano
     */
    public function setObservationPPM($observationPPM)
    {
        $this->observationPPM = $observationPPM;

        return $this;
    }

    /**
     * Get observationPPM
     *
     * @return string
     */
    public function getObservationPPM()
    {
        return $this->observationPPM;
    }

    /**
     * Set datereception
     *
     * @param \DateTime $datereception
     *
     * @return Dano
     */
    public function setDatereception($datereception)
    {
        $this->datereception = $datereception;

        return $this;
    }

    /**
     * Get datereception
     *
     * @return \DateTime
     */
    public function getDatereception()
    {
        return $this->datereception;
    }

    /**
     * Set requete
     *
     * @param \PPCA\SiseBundle\Entity\Requete $requete
     *
     * @return Dano
     */
    public function setRequete(\PPCA\SiseBundle\Entity\Requete $requete = null)
    {
        $this->requete = $requete;

        return $this;
    }

    /**
     * Get requete
     *
     * @return \PPCA\SiseBundle\Entity\Requete
     */
    public function getRequete()
    {
        return $this->requete;
    }

    /**
     * Set destinataire
     *
     * @param \PPCA\ParametreBundle\Entity\Bailleur $destinataire
     *
     * @return Dano
     */
    public function setDestinataire(\PPCA\ParametreBundle\Entity\Bailleur $destinataire = null)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return \PPCA\ParametreBundle\Entity\Bailleur
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set activite
     *
     * @param \PPCA\ParametreBundle\Entity\Activite $activite
     *
     * @return Dano
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

    /**
     * Add piecejointe
     *
     * @param \PPCA\SiseBundle\Entity\PieceJointeDano $piecejointe
     *
     * @return Dano
     */
    public function addPiecejointe(\PPCA\SiseBundle\Entity\PieceJointeDano $piecejointe)
    {
        $this->piecejointe[] = $piecejointe;

        $piecejointe->setDano($this);

        return $this;
    }

    /**
     * Remove piecejointe
     *
     * @param \PPCA\SiseBundle\Entity\PieceJointeDano $piecejointe
     */
    public function removePiecejointe(\PPCA\SiseBundle\Entity\PieceJointeDano $piecejointe)
    {
        $this->piecejointe->removeElement($piecejointe);
    }

    /**
     * Get piecejointe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPiecejointe()
    {
        return $this->piecejointe;
    }

    /**
     * Add etape
     *
     * @param \PPCA\SiseBundle\Entity\HistoriqueDano $etape
     *
     * @return Dano
     */
    public function addEtape(\PPCA\SiseBundle\Entity\HistoriqueDano $etape)
    {
        $this->etape[] = $etape;

        return $this;
    }

    /**
     * Remove etape
     *
     * @param \PPCA\SiseBundle\Entity\HistoriqueDano $etape
     */
    public function removeEtape(\PPCA\SiseBundle\Entity\HistoriqueDano $etape)
    {
        $this->etape->removeElement($etape);
    }

    /**
     * Get etape
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set etat
     *
     * @param \PPCA\SiseBundle\Entity\Etat $etat
     *
     * @return Dano
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
