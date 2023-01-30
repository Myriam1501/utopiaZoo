<?php

namespace App\Form;

use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Nom  : ',
                'required' => true,
                'attr' => ['autocomplete' => false, 'placeholder' => 'Nom'],

            ])
            ->add('first_name', TextType::class, [
                'label'=> 'Prénom : ',
                'required' => true,
                'attr' => ['autocomplete' => false, 'placeholder' => 'Prenom'],

            ])
            ->add('Address', TextType::class,[
                'label'=> 'Adresse :',
                'required' => false,
                'attr' => ['placeholder' => 'Adresse'],

            ])
            ->add('Passeword', PasswordType::class, [
                'label'=> ' Mot de passe (Min 8 chiffres, ex: Aa1234567) : ',
                'required' => true,
                'attr' => ['autocomplete' => false, 'placeholder' => 'Passeword']
            ])
            ->add('Email_Login', EmailType::class, [
                'label'=> 'E-mail :',
                'required' => true,
                'attr' => ['placeholder' => 'Email'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
