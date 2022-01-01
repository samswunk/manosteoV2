<?php

namespace App\Form;

use App\Entity\Antecedent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AntecedentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orl', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'ORL',
                    ],
                    'label'=>'ORL', 
                'required'  => false
            ])
            ->add('neuro', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Neurologie',
                    ],
                'label'=>'Neurologie', 
                'required'  => false
            ])
            ->add('vr', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Motif de consultation',
                    ],
                'label'      => 'Voies Respiratoires', 
                'required'  => false
            ])
            ->add('allergie', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Voies Respiratoires',
                    ],
                'label'      => 'Voies Respiratoires', 
                'required'  => false
            ])
            ->add('cardio', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Cardiologie', 
                'required'  => false
            ])
            ->add('digest', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Digestif', 
                'required'  => false
            ])
            ->add('uro', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Urologie', 
                'required'  => false
            ])
            ->add('gyneco', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Gynécologie', 
                'required'  => false
            ])
            ->add('sommeil', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Sommeil', 
                'required'  => false
            ])
            ->add('grossesse', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Grossesse', 
                'required'  => false
            ])
            ->add('vaccin', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Vaccination', 
                'required'  => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Antecedent::class,
        ]);
    }
}
