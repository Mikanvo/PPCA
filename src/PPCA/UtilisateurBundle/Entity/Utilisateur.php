<?php
namespace PPCA\UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="PPCA\UtilisateurBundle\Repository\UtilisateurRepository")
 * @GRID\Source(columns="id, username, employe.nom, enabled, locked, expired")
 */
class Utilisateur extends BaseUser
{
	public function __construct()
	{
		parent::__construct();
		$this->groups = new ArrayCollection();
	}

	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(visible=false)
     *
	*/
	protected $id;

    /**
     * @ORM\OneToOne(targetEntity="\PPCA\UtilisateurBundle\Entity\Employe", cascade={"persist"})
     * @GRID\Column(field="employe.nom", title="Employe")
     */    
    private $employe;

	/**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Groupe", inversedBy="utilisateurs")
     * @ORM\JoinTable(name="utilisateurs_groupes")
     */
    protected $groups;
	
	function getExpiresAt() {
        return $this->expiresAt;
    }
	
	function getCredentialsExpired() {
        return $this->credentialsExpired;
    }
 
    function getCredentialsExpireAt() {
        return $this->credentialsExpireAt;
    }
	
	function setGroups(Collection $groups = null) {
        if ($groups !== null)
            $this->groups = $groups;
    }
 
    /*public function setRoles(array $roles = array()) {
        $this->roles = array();
        foreach ($roles as $role)
            $this->addRole($role);
        return $this;
    }*/
 
    public function hasGroup($name = '') {
        return in_array($name, $this->getGroupNames());
    }

    /**
     * Set employe
     *
     * @param \PPCA\ParametreBundle\Entity\Employe $employe
     * @return Utilisateur
     */
    public function setEmploye(\PPCA\ParametreBundle\Entity\Employe $employe = null)
    {
        $this->employe = $employe;

        return $this;
    }

    /**
     * Get employe
     *
     * @return \PPCA\ParametreBundle\Entity\Employe
     */
    public function getEmploye()
    {
        return $this->employe;
    }
}
