<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['data'] ?? null;
        $filePath = $user ? $user->getAvatar() : null;

        $builder
            ->add('email', EmailType::class,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('roles', TextType::class,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('isMale',null,[
                'attr' => ['class' => 'input-group ']
            ])
            ->add('firstName',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('lastName', TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            ->add('birthDate', DateTimeType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            /*->add('avatarPath', FileType::class, [
                'label' => 'Avatar ('.$filePath.')',
                'mapped' => false,
                'data' => new File($filePath),
                'attr' => ['class' => 'form-control'],
                ])*/
            ->add('createdAt', DateTimeType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('pseudo',TextType::class ,[
                'attr' => ['class' => 'input-group form-control']
            ])
            //->add('address', AddressType::class)
            ->add('update', SubmitType::class,[
                'label' => 'Update',
                'attr' => ['class' => 'input-group form-control btn btn-primary w-25 mt-3']
            ])
        ;
        $builder->get('roles')
                ->addModelTransformer(new CallbackTransformer(
                    function($rolesArray):string{
                        return implode(', ', $rolesArray);
                    },
                    function($rolesAsString): array{
                        return explode(', ', $rolesAsString);
                    }
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
