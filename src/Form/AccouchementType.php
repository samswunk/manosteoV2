<?php

namespace App\Form;

use App\Entity\Accouchement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccouchementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('difficultes', ChoiceType::class, [
                'attr' => 
                    [
                        'class' => 'form-control'
                    ],
                'expanded' => true,
                'multiple' => false,
                'choices' => array(
                    'Eutocique' => 1,
                    'Distocique' => 2
                 ),
                 'label' => 'Difficultés', 
                'required'  => false
             ])
            ->add('conditions', ChoiceType::class, [
                'attr' => 
                    [
                        'class' => 'form-control'
                    ],
                'choices' => array(
                    'Spontané' => 1,
                    'Programmé' => 2,
                    'Provoqué' => 3
                 ),
                 'label' => 'Conditions', 
                'required'  => false
             ])
            ->add('peridurale',CheckboxType::class,[
                'label' => 'Péridurale',
                'required'  => false
           ])
            ->add('episiotomie',CheckboxType::class,[
                'label' => 'Épisiotomie',
                'required'  => false
           ])
            ->add('instrumentalisation', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Instrumentalisation', 
                'required'  => false
            ])
            ->add('presentation', ChoiceType::class, [
                'attr' => 
                    [
                        'class' => 'form-control'
                    ],
                'choices' => array(
                    'Sommet' => 0,
                    'Siège' => 1,
                    'Face' => 2,
                    'Transversal' => 3
                 ),
                 'label' => 'Présentation', 
                'required'  => false
             ])
            ->add('remarques', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                    ],
                'label'      => 'Remarques', 
                'required'  => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Accouchement::class,
        ]);
    }
}
