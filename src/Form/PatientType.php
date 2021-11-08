<?php

namespace App\Form;

use App\Entity\Antecedent;
use App\Entity\EnvoyePar;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->setAction('target_route')
            // ->setMethod('GET')
            ->add('Nom', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Nom',
                    ],
                
                'required'      => true
            ])
            ->add('prenom', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Prénom',
                    ],
                
                'required'      => false
            ])
            ->add('situation', ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                // 'data' => false,
                'choices' => array(
                    'Célibataire'   =>"Célibataire",
                    'En couple'     =>"En couple",
                    'Pacsé(e)'      =>"Pacsé(e)",
                    'Marié(e)'      =>"Marié(e)",
                    'Divorcé(e)'    =>"Divorcé(e)",
                    'Veuf(ve)'      =>"Veuf(ve)"
                 ),
                 'placeholder' => 'Situation familliale',
                 'attr' => 
                     [
                         'class' => 'form-control disponible'
                     ],
                 'label' => "Situation",
             ])
            ->add('sexe', ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                // 'data' => false,
                'choices' => array(
                    'Femme' => 2, // disponible
                    'Homme' => 1,
                    'Autre' => 0
                 ),
                 'placeholder' => 'Sexe',
                 'label' => false,
                //  'label_attr'=>[
                //      'class'=>'radio-inline'
                //          ]
             ])
            ->add('Profession', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Profession',
                    ],
                
                'required'      => false
            ])
            ->add('Secu', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'N° Sécu',
                    ],
                
                'required'      => true
            ])
            ->add('dateNaissance', DateTimeType::class, [
                'widget'=> 'single_text',
                'required' => true,
                'attr' => 
                    [
                        'class' => 'form-control datetimepicker',
                        'data-provide' => 'datetimepicker',
                        'format'=> 'dd/MM/yyyy',
                        'input' => 'string',
                        'input_format' => 'y-M-d'
                    ],
                'html5'=> false,
                'format'=> 'dd/MM/yyyy', 
                'label'=>'Date de naissance'                        
            ])
            ->add('remarques', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Remarques',
                    ],
                
                'required'      => false
            ])
            
            ->add('nbEnfant'    , NumberType::class, [
                'attr' => 
                    [   'placeholder' => "Nbre d'enfants",
                    ],
                
                'required'      => false
            ])
            ->add('adresse'     , AdresseType::class)
            ->add('telephone'   , TelephoneType::class)
            // ->add('antecedent'  , AntecedentType::class)
            // ->add('accouchement', AccouchementType::class)
            // ->add('pediatrie'   , PediatrieType::class)
            // ->add('traumato'    , TraumatoType::class)
            ->add('envoyePar'   ,EntityType::class, [
                // looks for choices from this entity
                'class' => EnvoyePar::class,
                'choice_label' => function ($envoyePar) 
                    { return $envoyePar->getLibelle();  },
                'attr' => 
                    [
                        'class' => 'form-control',
                    ],
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
