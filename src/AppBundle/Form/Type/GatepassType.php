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
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                    'choice_label' => 'name',
                'label' => 'نوع التصريح'))

            ->add('company', EntityType::class, array(
                    'class' => 'AppBundle:Company',
                    'choice_label' => 'name',
                'label' => 'الجهه الطالبة'))

            ->add('national', EntityType::class, array(
                    'class' => 'AppBundle:National',
                    'choice_label' => 'name',
                'label' => 'الجنسية'))

            ->add('section', EntityType::class, array(
                    'class' => 'AppBundle:Section',
                    'choice_label' => 'name',
                'label' => 'القسم'))

            ->add('person', TextType::class, ['label' => 'إسم السائق'])
            ->add('fromDate', DateType::class, ['label' => 'من'])
            ->add('toDate', DateType::class, ['label' => 'إلى'])
            ->add('camera', CheckboxType::class, array(
                'label'     => 'كاميره',
                'required'  => false,
                'label_attr' => array(
                    'class' => 'checkbox-inline'
                )
            ))
            ->add('laptop', CheckboxType::class, array(
                'label'     => 'لابتوب',
                'required'  => false,
                'label_attr' => array(
                    'class' => 'checkbox-inline',
                )
            ))
            ->add('car', CheckboxType::class, array(
                'label'     => 'سيارة',
                'required'  => false,
                'label_attr' => array(
                    'class' => 'checkbox-inline'
                )
            ))
            ->add('carNo', TextType::class, ['label' => 'رقم السيارة'])
            ->add('carType', TextType::class, ['label' => 'نوع السيارة'])
            ->add('carColor', TextType::class, ['label' => 'لون السيارة'])
            ->add('reason', TextareaType::class, ['label' => 'السبب'])
            ->add('remarks', TextareaType::class, ['label' => 'ملاحظة'])

            ->add('items', CollectionType::class, array(
                'entry_type'       => ItemType::class,
                'prototype'         => true,
                'allow_add'         => true,
                'allow_delete'      => true,
                'by_reference'      => false,
                'label'             => 'المواد',
                'attr' => ['class' => '']
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