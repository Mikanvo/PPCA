<?php

namespace PPCA\ParametreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SousActiviteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('activite', EntityType::class,
                array(
                    'class'=>'ParametreBundle:Activite',
                    'choice_label' => 'libelle',
                    //'empty_value' => "--- Choisir une composante ---",
                    'empty_data' => "--- Choisir une activité ---"
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PPCA\ParametreBundle\Entity\SousActivite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ppca_parametrebundle_sousactivite';
    }


}
