<?php

namespace App\Form;

use App\Entity\Pediatrie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PediatrieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taille', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Taille',
                    ], 
                'label'=>    'Taille (cm)', 
                'required'  => false
            ])
            ->add('poids', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Poids',
                    ], 
                'label'=>    'Poids (g)', 
                'required'  => false
            ])
            ->add('pc', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                    ], 
                'label'=>    'Périmètre Crânien (cm)', 
                'required'  => false
            ])
            ->add('apgar1', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                    ], 
                'label'=>    'APGAR 1 min', 
                'required'  => false
            ])
            ->add('apgar5', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Poids',
                    ], 
                'label'=>    'APGAR 5 min', 
                'required'  => false
            ])
            ->add('apgar10', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Poids',
                    ], 
                'label'=>    'APGAR 10 min', 
                'required'  => false
            ])
            
            ->add('allaitement',CheckboxType::class,[
                'label' => 'Allaitement',
                'required'  => false
            ])
            ->add('tempsAllaitement', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Age de fin',
                    ],
                'required'  => false
            ])
            ->add('remarques', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'required'  => false
                    ],
                'label'      => 'Remarques', 
                'required'  => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pediatrie::class,
        ]);
    }
}
