<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('line1',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('line2',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('line3',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('postCode',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('city',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
