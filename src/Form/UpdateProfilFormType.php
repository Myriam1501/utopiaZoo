<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
