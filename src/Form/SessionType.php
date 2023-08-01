<?php

namespace App\Form;

use App\Entity\Intern;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('dateStart', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('dateEnd', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('nbrsPlaces', IntegerType::class, [
                
                'attr' => [
                    'class' => 'form-control'

                ]
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
            'data_class' => Session::class,
        ]);
    }
}
