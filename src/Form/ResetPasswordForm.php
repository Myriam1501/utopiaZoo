<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ResetPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('passWord', PasswordType::class, [
                'label'=> ' Mot de passe : ',
                'mapped'=>false,
                'required' => true,
                'attr' => ['autocomplete' => 'new-password','placeholder' => 'mot de passe'],
                'constraints' => [
                    new NotBlank(['message'=>'Please enter your password']),
                    new Length(['min'=>6,
                        'minMessage'=> 'votre password doit avoir 8 caractères min',
                        'max'=>20,
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}