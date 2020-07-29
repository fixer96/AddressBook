<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', TextType::class, [
                'attr' => [
                    'maxlength' => 50
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'maxlength' => 50
                ]
            ])
            ->add('street', TextType::class, [
                'attr' => [
                    'maxlength' => 50
                ]
            ])
            ->add('zipCode', TextType::class, [
                'attr' => [
                    'maxlength' => 10
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Address::class
        ));
    }
}
