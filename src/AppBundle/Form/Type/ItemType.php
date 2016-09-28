<?php
/**
 * Created by PhpStorm.
 * User: suliman
 * Date: 27/09/16
 * Time: 12:28 م
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('srlno')
            ->add('qty')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Items',
        ));
    }

}