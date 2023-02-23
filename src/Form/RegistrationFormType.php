<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> 'E-mail :',
                'required' => true,
                'attr' => ['placeholder' => 'Email'],
            ])
            ->add('first_name', TextType::class, [
                'label'=> 'Prénom : ',
                'required' => true,
                'attr' => ['autocomplete' => false, 'placeholder' => 'Prenom'],

            ])
            ->add('name', TextType::class,[
                'label' => 'Nom  : ',
                'required' => true,
                'attr' => ['autocomplete' => false, 'placeholder' => 'Nom'],

            ])
            ->add('address', TextType::class,[
                'label'=> 'Adresse :',
                'required' => false,
                'attr' => ['placeholder' => 'Address'],

            ])

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
            'data_class' => User::class,
        ]);
    }
}
