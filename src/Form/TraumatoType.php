<?php

namespace App\Form;

use App\Entity\Traumato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraumatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fractures', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Fractures'
                    ],
                'label'      => 'Fractures', 
                'required'  => false
            ])
            ->add('entorses', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Entorses'
                    ],
                'label'      => 'Entorses', 
                'required'  => false
            ])
            ->add('accidents', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Accidents'
                    ],
                'label'      => 'Accidents', 
                'required'  => false
            ])
            ->add('operations', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col',
                        'placeholder' => 'Operations'
                    ],
                'label'      => 'Operations', 
                'required'  => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Traumato::class,
        ]);
    }
}
