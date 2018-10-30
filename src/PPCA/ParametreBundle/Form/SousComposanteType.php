<?php

namespace PPCA\ParametreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SousComposanteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('composante', EntityType::class,
                    array(
                        'class'=>'ParametreBundle:Composante',
                        'choice_label' => 'libelle',
                        //'empty_value' => "--- Choisir une composante ---",
                        'empty_data' => "--- Choisir une composante ---"
                    )
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PPCA\ParametreBundle\Entity\SousComposante'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ppca_parametrebundle_souscomposante';
    }


}
