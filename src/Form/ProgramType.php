<?php

namespace App\Form;

use App\Entity\Program;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Title',
                'attr'=>['autocomplete'=> 'Votre Titre'],
            ])
            ->add('date_deb', DateTimeType::class, [
                'date_label' => 'Starts On',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ],
            ])
            ->add('date_fin', DateTimeType::class, [
                'date_label' => 'Time Finish',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ],
            ])
            ->add('description_program',TextareaType::class, [
                'label'=>'Description_program',
                'attr'=>['autocomplete'=> 'Votre description de program'],
            ] )
            ->add('age_min', IntegerType::class, [
                'mapped'=>false,
                'attr'=>['autocomplete'=> 'Votre age'],
                'constraints'=>[
                    new NotBlank([
                        'message'=> 'Entrez votre age'
                    ]),
                    new Length([
                        'min'=>1,
                        'max'=>3,
                    ])
                ]
            ])
            ->add('pictureDecoPath', UrlType::class)
            ->add('timer_program',TimeType::class)
            ->add('price', MoneyType::class)
            ->add('price_reduce', MoneyType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
