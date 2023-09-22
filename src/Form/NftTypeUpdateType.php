<?php

namespace App\Form;

use App\Entity\NftType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NftTypeUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $type = $options['data'] ?? null;
        if ($type->getId() !== null) {
            $builder
                ->add('designation')
                ->add('add', SubmitType::class, [
                    'label' => 'Update Type',
                    'attr' => ['class' => 'input-group form-control btn btn-primary w-25 mt-3']
                ])
            ;
        }else{
            $builder
                ->add('designation')
                ->add('add', SubmitType::class, [
                    'label' => 'Add Type',
                    'attr' => ['class' => 'input-group form-control btn btn-primary w-25 mt-3']
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NftType::class,
        ]);
    }
}