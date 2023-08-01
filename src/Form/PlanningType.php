<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PlanningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbrsOfDays', IntegerType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choice_label' => 'name',
                // 'mapped' => false
            ])
            ->add('module', EntityType::class, [
                'class' => Module::class,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choice_label' => 'name',
                // 'mapped' => false
            ])
            ->add('validate', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark btn-lg'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
        ]);
    }
}
