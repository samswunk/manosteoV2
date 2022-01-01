<?php

namespace App\Form;

use App\Entity\Consultation;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateTimeType::class, [
                'widget'=> 'single_text',
                'required' => true,
                'attr' => 
                    [
                        'class'         => 'form-control datepicker col-6 bg-transparent border-0 m-0 p-0',
                        'data-provide'  => 'datepicker',
                        'format'        => 'dd/MM/yyyy',
                        'input'         => 'string',
                        'input_format'  => 'y-M-d', 
                        'value'         => date('d/m/Y')
                    ],
                'html5'         => false,
                'format'        => 'dd/MM/yyyy',
                'label'         => false,
                'required'      => false                       
            ])
            ->add('motif', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Motif de consultation',
                    ],
                'required'      => true
            ])
            ->add('test', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Tests',
                    ],
                'required'      => true
            ])
            ->add('traitement', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Traitements',
                    ],
                'required'      => true
            ])
            ->add('domicile',CheckboxType::class,[
                 'label' => 'Consultation à domicile',
                 'attr' => 
                    [
                        'class' => 'col-1 text-left'
                    ],
                    'label_attr' => 
                    [
                        'class' => 'col-2 text-right p-0 m-0'
                    ], 
                    'required'=>false
            ])
            ->add('facture'     , FactureType::class,[
                'required'      => false,
                'attr'          => ['class'=>'col-12'],
                'label_attr'    => ['class'=>'h3']
            ])            
            -> add('patient'    ,ConsultPatientType::class,[
                'required'      => false,
                'attr'          => ['class'=>'m-1'],
                'label_attr'    => ['class'=>'h3']
            ])
            // ->add('user'        , UserType::class)
            // ->add('antecedent'  , AntecedentType::class)
            // ->add('accouchement', AccouchementType::class)
            // ->add('pediatrie'   , PediatrieType::class)
            // ->add('traumato'    , TraumatoType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
