<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $category = $options['data'] ?? null;
        if($category->getId() !== null){
            $builder
            ->add('name')
            ->add('representation')
            ->add('update', SubmitType::class,[
                'label' => 'Update',
                'attr' => ['class' => 'input-group form-control btn btn-primary w-25 mt-3']
            ])
        ;
        } else{
            
            $builder
            ->add('name')
            ->add('representation')
            ->add('add', SubmitType::class,[
                'label' => 'Add Category',
                'attr' => ['class' => 'input-group form-control btn btn-primary w-25 mt-3']
            ])
        ;
        }
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
