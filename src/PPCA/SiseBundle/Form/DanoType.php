<?php

namespace PPCA\SiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DanoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero',TextType::class,array('label'=>'Numero'))
            ->add('objet',TextType::class,array('label'=>'Objet'))
            ->add('corps',TextareaType::class,array('label'=>'Message'))
            ->add('datereception',DateType::class,array("widget"=>"single_text", 'label'=>'Date de reception', 'format' => 'dd/MM/yyyy'))
            ->add('description',TextareaType::class,array('label'=>'Description de la requête'))
            ->add('beneficiaire',TextType::class,array('label'=>'Beneficiaire'))
            ->add('observation',TextareaType::class,array('label'=>'Observations'))
            ->add('observationPTBA',TextareaType::class,array('label'=>'Observation PTBA'))
            ->add('observationPPM',TextareaType::class,array('label'=>'Observation PPM'))
            /*->add('expediteur',EntityType::class,
                array(
                    'class'=>'UtilisateurBundle:Utilisateur',
                    'choice_label' => 'email',
                    //'empty_value' => "--- Choisir une composante ---",
                    'empty_data' => "-Choisir un utilisateur-"
                ))*/
            //->add('etat')
            ->add('requete', EntityType::class,
                array(
                    'class'=>'SiseBundle:Requete',
                    'choice_label' => 'libelle',
                    //'empty_value' => "--- Choisir une composante ---",
                    'empty_data' => "-Choisir une requete-"
                ))
            ->add('destinataire', EntityType::class,
                array(
                    'class'=>'ParametreBundle:Bailleur',
                    'choice_label' => 'libelle',
                    //'empty_value' => "--- Choisir une composante ---",
                    'empty_data' => "-Choisir un destinataire-"
                ))
            ->add('activite', EntityType::class,
                array(
                    'class'=>'ParametreBundle:Activite',
                    'choice_label' => 'libelle',
                    //'empty_value' => "--- Choisir une composante ---",
                    'empty_data' => "-Selectionnez une activite-"
                ))
            /*->add('piecejointe',CollectionType::class , array(
                'entry_type'	=> PieceJointeDanoType::class,
                'label' 		=> false,
                'allow_add'    	=> true,
                'allow_delete' 	=> true,
                'by_reference' 	=> false,
                'options' 		=> array('label' => false)))*/;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PPCA\SiseBundle\Entity\Dano'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ppca_sisebundle_dano';
    }


}
