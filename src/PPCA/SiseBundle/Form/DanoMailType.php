<?php
/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 03/11/2018
 * Time: 13:42
 */

namespace PPCA\SiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class DanoMailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('destinataire',EmailType::class,array('label'=>'À', 'required'=>true))
            ->add('copie',EmailType::class,array('label'=>'Cc', 'required'=>true))
            ->add('objet',TextType::class,array('label'=>'Objet', 'required'=>true))
            ->add('message',TextareaType::class,array('label'=>'Message', 'required'=>true))
        ;
    }

}