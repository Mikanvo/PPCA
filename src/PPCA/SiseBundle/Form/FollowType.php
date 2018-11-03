<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 03/11/2018
 * Time: 16:18
 */

namespace PPCA\SiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class FollowType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dano',EntityType::class,
                array(
                    'label'=>'Numero',
                    'required'=>true,
                    'class'=>'SiseBundle:Dano',
                    'choice_label' => 'libelle',
                    'empty_data' => "-Choisir une DANO-"
                ))
       ;
    }

}