<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 27/09/16
 * Time: 01:11 م
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\Type\ItemType;

class GatepassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('GatepassType', EntityType::class, array(
                    'class' => 'AppBundle:GatepassType',
                    'choice_label' => 'name'))

            ->add('company', EntityType::class, array(
                    'class' => 'AppBundle:Company',
                    'choice_label' => 'name'))

            ->add('national', EntityType::class, array(
                    'class' => 'AppBundle:National',
                    'choice_label' => 'name'))

            ->add('section', EntityType::class, array(
                    'class' => 'AppBundle:Section',
                    'choice_label' => 'name'))

            ->add('person')
            ->add('fromDate', DateType::class)
            ->add('toDate', DateType::class)
            ->add('camera', CheckboxType::class, array(
                'label'     => 'Camera',
                'required'  => false,
            ))
            ->add('laptop', CheckboxType::class, array(
                'label'     => 'Laptop',
                'required'  => false,
            ))
            ->add('car', CheckboxType::class, array(
                'label'     => 'Car',
                'required'  => false,
            ))
            ->add('carNo')
            ->add('carType')
            ->add('carColor')
            ->add('reason', TextareaType::class)
            ->add('remarks', TextareaType::class)

            ->add('items', CollectionType::class, array(
                'entry_type'       => ItemType::class,
                'prototype'         => true,
                'allow_add'         => true,
                'allow_delete'      => true,
                'by_reference'      => false,
            ))
            ->add('save', SubmitType::class, ['label' => 'حفظ', 'attr' => ['class' => 'btn-primary']])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Gatepass',
        ));
    }
}