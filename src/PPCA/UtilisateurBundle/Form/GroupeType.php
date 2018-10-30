<?php

namespace PPCA\UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('roles', 'collection', array('type' => 'choice',
                                			    'allow_add'    => true,
                                			    'allow_delete' => true,
                                				'options' => array('label' => false,
                                                  					'empty_value' => '-- Choisir un groupe --',
                                                  					'empty_data'  => null,
                                                                    'choices' => array('ROLE_USER' => 'Utilisateur',
                                                                        'ROLE_ADMIN' => 'Administrateur',
                                                                        'ROLE_SUPER_ADMIN' => 'Super Administrateur',
                                                                        'ROLE_PARAMETRE_ALL' => 'Parametre (admin)',
                                                                        'ROLE_PARAMETRE_VIEW' => 'Parametre (consultation)',
                                                                        'ROLE_CLIENT_ALL' => 'Client (admin)',
                                                                        'ROLE_CLIENT_VIEW' => 'Client (consultation)',
                                                                        'ROLE_DEMANDE_ALL' => 'Demande (admin)',
                                                                        'ROLE_DEMANDE_VIEW' => 'Demande (consultation)',
                                                                        'ROLE_FACTURATION_ALL' => 'Facture (admin)',
                                                                        'ROLE_FACTURATION_VIEW' => 'Facture (consultation)',
                                                                        'ROLE_EDITION_ALL' => 'Edition',
                                                                        //'ROLE_EDITION_VIEW' => 'Utilisateur',
                                                                    )
                   )
               )
           )
            //->add('utilisateur')
            //->add('user')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PPCA\UtilisateurBundle\Entity\Groupe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'PPCA_utilisateurbundle_groupe';
    }
}
