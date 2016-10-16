<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 27/09/16
 * Time: 12:28 م
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'إسم المادة'])
            ->add('srlno', TextType::class , [
                'data' => '0',
                'label' => 'رقم المادة'
            ])
            ->add('qty', NumberType::class, [
                'data' => 0,
                'label' => 'الكمية'
            ])
            ->add('delete', ButtonType::class, [
                'attr' => ['class' => 'delete_item btn btn-danger'],
                'label' => 'حذف'
                ]
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Items',
            'attr' => ['class' => 'item']
        ));
    }

    public function getName()
    {
        return 'itemsType';
    }

}