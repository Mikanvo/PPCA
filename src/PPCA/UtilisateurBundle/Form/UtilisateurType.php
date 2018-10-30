<?php

namespace PPCA\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text',array('label' => 'Pseudo'))
            //->add('usernameCanonical')
            ->add('email','email',array('label' => 'E-mail'))
            //->add('emailCanonical')
            ->add('enabled','checkbox',array('label' => 'Activer'))
            //->add('salt')
            //->add('password')
			->add('plainPassword', 'repeated', array('type' => 'password',
                                                    'invalid_message' => 'Les mots de passe doivent être identiques.',
                                                    'required' => $options['passwordRequired'],
                                                    'first_options'  => array('label' => 'Mot de passe'),
                                                    'second_options' => array('label' => 'Répétez'),
            ))
            //->add('lastLogin')
            //->add('locked')
            //->add('expired')
            //->add('expiresAt')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('credentialsExpired')
            //->add('credentialsExpireAt')
            ->add('groups', 'entity', array(
                'label' => 'Groupes',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'class' => 'PPCA\UtilisateurBundle\Entity\Groupe'))
            //->add('group')
            ->add('employe','entity',array('class'=>'ParametreBundle:Employe',
                                            'property' => 'nomComplet',
                                            'empty_value' => "--- Choisir un employe ---",
                                            'empty_data' => null,
                                            'label' => 'Employé'
                                            ))
        ;
		if ($options['lockedRequired']) {
            $builder->add('locked', null, array('required' => false, 
                'label' => 'Vérouiller le compte'));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PPCA\UtilisateurBundle\Entity\Utilisateur',
            'passwordRequired' => true,
            'lockedRequired' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'PPCA_utilisateurbundle_utilisateur';
    }
}
