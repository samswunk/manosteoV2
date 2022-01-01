<?php

namespace App\Form;

use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateTimeType::class, [
                'widget'=> 'single_text',
                'required' => true,
                'attr' => 
                    [
                        'class'         => 'form-control datepicker col-2 m-0 p-0',
                        'data-provide'  => 'datepicker',
                        'format'        => 'dd/MM/yyyy',
                        'input'         => 'string',
                        'input_format'  => 'y-M-d'
                    ],
                'html5'=> false,
                'format'=> 'dd/MM/yyyy', 
                'label'=>false                       
            ])
            ->add('motif', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-12 m-0 p-0',
                        'placeholder' => 'Motif de consultation',
                    ],
                'label'         => false,
                'required'      => true
            ])
            ->add('test', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-12 m-0 p-0',
                        'placeholder' => 'Tests',
                    ],
                    'label'         => false,
                    'required'      => true
            ])
            ->add('traitement', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-12 m-0 p-0',
                        'placeholder' => 'Traitements',
                    ],
                    'label'         => false,
                    'required'      => true
            ])
            ->add('domicile',CheckboxType::class,[
                 'label'    => 'Consultation à domicile',
                 'required' => false
            ])
            // ->add('patient')
            // ->add('user'        , UserType::class)
            ->add('facture'     , FactureType::class,[
                'label_attr'=> ['class'=>'h3']
            ] )       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
