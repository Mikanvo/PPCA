<?php

namespace PPCA\SiseBundle\Entity;

/**
 * Dano
 */
class Dano
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var \stdClass
     */
    private $expediteur;

    /**
     * @var string
     */
    private $objet;

    /**
     * @var string
     */
    private $corps;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \stdClass
     */
    private $etat;

    /**
     * @var \stdClass
     */
    private $requete;

    /**
     * @var \stdClass
     */
    private $destinataire;

    /**
     * @var \stdClass
     */
    private $activite;

    /**
     * @var string
     */
    private $beneficiaire;

    /**
     * @var string
     */
    private $observation;

    /**
     * @var string
     */
    private $ptba;

    /**
     * @var string
     */
    private $observationPPM;

    /**
     * @var string
     */
    private $obsercationPTBA;


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
     * Set expediteur
     *
     * @param \stdClass $expediteur
     *
     * @return Dano
     */
    public function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * Get expediteur
     *
     * @return \stdClass
     */
    public function getExpediteur()
    {
        return $this->expediteur;
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
     * Set etat
     *
     * @param \stdClass $etat
     *
     * @return Dano
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \stdClass
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set requete
     *
     * @param \stdClass $requete
     *
     * @return Dano
     */
    public function setRequete($requete)
    {
        $this->requete = $requete;

        return $this;
    }

    /**
     * Get requete
     *
     * @return \stdClass
     */
    public function getRequete()
    {
        return $this->requete;
    }

    /**
     * Set destinataire
     *
     * @param \stdClass $destinataire
     *
     * @return Dano
     */
    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return \stdClass
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set activite
     *
     * @param \stdClass $activite
     *
     * @return Dano
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
     * Set ptba
     *
     * @param string $ptba
     *
     * @return Dano
     */
    public function setPtba($ptba)
    {
        $this->ptba = $ptba;

        return $this;
    }

    /**
     * Get ptba
     *
     * @return string
     */
    public function getPtba()
    {
        return $this->ptba;
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
     * Set obsercationPTBA
     *
     * @param string $obsercationPTBA
     *
     * @return Dano
     */
    public function setObsercationPTBA($obsercationPTBA)
    {
        $this->obsercationPTBA = $obsercationPTBA;

        return $this;
    }

    /**
     * Get obsercationPTBA
     *
     * @return string
     */
    public function getObsercationPTBA()
    {
        return $this->obsercationPTBA;
    }
}

