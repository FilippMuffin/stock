<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use SYmfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheridoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label'=>'Название: '])
            ->add('quantity', null, ['label'=>'Количество: '])
            ->add('weight', null, ['label'=>'Вес: ']);
        $builder->setRequired(false);
    }

    /**
     * {@inheridoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\Product',
        ));
    }

    /**
     * {@inheridoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }
}