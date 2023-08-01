<?php

namespace App\Form;

use App\Entity\Intern;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InternType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('lastName', TextType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    '' => '',
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other',
                ],
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('townOfResidence', TextType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('email', TextType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('phoneNbr', TextType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('sessions', EntityType::class, [
                'class' => Session::class,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choice_label' => 'name',
                'mapped' => false
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark btn-lg'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intern::class,
        ]);
    }
}
