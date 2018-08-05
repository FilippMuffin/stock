<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use SYmfony\Component\OptionsResolver\OptionsResolver;

class ForemanType extends AbstractType
{
    /**
     * {@inheridoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label'=>'Имя: '])
            ->add('surname', null, ['label'=>'Фамилия: '])
            ->add('role')
            ->add('salt')
            ->add('email', null, ['label'=>'Почта: '])
            ->add('password', null, ['label'=>'Пароль: ']);
    }

    /**
     * {@inheridoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\Foreman',
        ));
    }

    /**
     * {@inheridoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_foreman';
    }
}