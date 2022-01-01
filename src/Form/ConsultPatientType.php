<?php

namespace App\Form;

use App\Entity\Antecedent;
use App\Entity\EnvoyePar;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultPatientType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->setAction('target_route')
            // ->setMethod('GET')
            
            ->add('envoyePar'   , EntityType::class, 
                [
                    // looks for choices from this entity
                    'class'         => EnvoyePar::class,
                    'choice_label'  => function ($envoyePar) 
                        { 
                            return $envoyePar->getLibelle();  
                        },
                    'attr' => 
                        [
                            'class' => 'form-control col-6 bg-transparent border-0 m-0 p-0',
                        ],
                        // used to render a select box, check boxes or radios
                    'multiple'      => false,
                    'expanded'      => false,
                    'label'         => false,
                ])
            ->add('prenom', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-6 bg-transparent border-0 m-0 p-0',
                        'placeholder' => 'Prénom',
                    ],
                'required'      => false,
                'label'        => false,
            ])
            ->add('Nom', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-6 bg-transparent border-0 m-0 p-0',
                        'placeholder' => 'Nom',
                    ],
                'required'      => false,
                'label'        => false,
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
                         'class' => 'form-control disponible col-6 bg-transparent border-0 m-0 p-0'
                     ],
                 'label'        => false,
                 'required'     => false
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
                 'attr' => 
                    [   'class'       => 'select2 col-6 bg-transparent border-0 m-0 p-0',
                        'placeholder' => 'sexe',
                    ],
                 'placeholder'  => 'Sexe',
                 'label'        => false,
                 'required'     => false
             ])
            ->add('Profession', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-6 bg-transparent border-0 m-0 p-0',
                        'placeholder' => 'Profession',
                    ],
                'required'      => false,
                'label'        => false,
            ])
            ->add('Secu', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-6 bg-transparent border-0 m-0 p-0',
                        'placeholder' => 'N° Sécu',
                    ],
                'required'      => false,
                'label'        => false,
            ])
            ->add('dateNaissance', DateTimeType::class, [
                'widget'=> 'single_text',
                'required' => true,
                'attr' => 
                    [
                        'class' => 'form-control datepicker col-6 bg-transparent border-0 m-0 p-0',
                        'data-provide' => 'datepicker',
                        'format'=> 'dd/MM/yyyy',
                        'input' => 'string',
                        'input_format' => 'y-M-d'
                    ],
                'html5'         => false,
                'format'        => 'dd/MM/yyyy',
                'label'         => false,
                'required'      => false                       
            ])
            ->add('remarques', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-12',
                        'placeholder' => 'Remarques',
                    ],
                'required'      => false,
                'label'         => 'Remarques'
            ])
            ->add('antecedents', TextareaType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-12',
                        'placeholder' => 'Antécédents',
                    ],
                'required'      => false,
                'label'         => 'Antécédents'
            ])
            
            ->add('nbEnfant'    , NumberType::class, [
                'attr' => 
                    [   'class'       => 'form-control col-2 bg-transparent border-0 m-0 p-0',
                        'placeholder' => "Nbre d'enfants",
                    ],
                'required'      => false,
                'label'        => false,
            ])
            ->add('adresse'     , AdresseType::class, [
                'attr' => 
                    [   'class'       => 'row bg-transparent border-0 m-0 p-0',
                        'placeholder' => "Adresse",
                    ],
                'required'      => false,
                'label'         => 'Adresse',
                'label_attr'    => ['class'=>'h3']
            ])
            ->add('telephone'   , TelephoneType::class, [
                'attr' => 
                    [   'class'       => 'row bg-transparent border-0 m-0 p-0',
                        'placeholder' => "Telephone",
                    ],
                'required'  => false,
                'label'     => 'Téléphone',
                'label_attr'  => ['class'=>'h3']
            ])
            ->add('antecedent'  , AntecedentType::class, [
                'attr' => 
                    [   'class'       => 'row col-12 m-0 p-0',
                        'placeholder' => "Antécédents",
                    ],
                'required'  => false,
                'label'     => 'Antécédents',
                'label_attr'  => ['class'=>'h3']
            ])
            ->add('accouchement', AccouchementType::class, [
                'attr' => 
                    [   'class'       => 'row col-12 m-0 p-0',
                        'placeholder' => "Accouchement",
                    ],
                'required'  => false,
                'label'     => 'Accouchement',
                'label_attr'  => ['class'=>'h3']
            ])
            ->add('pediatrie'   , PediatrieType::class, [
                'attr' => 
                    [   'class'       => 'row col-12 m-0 p-0',
                        'placeholder' => "Pédiatrie",
                    ],
                'required'  => false,
                'label'     => 'Pédiatrie',
                'label_attr'  => ['class'=>'h3']
            ])
            ->add('traumato'    , TraumatoType::class, [
                'attr' => 
                    [   'class'       => 'row col-12 m-0 p-0',
                        'placeholder' => "Traumatologie",
                    ],
                'required'  => false,
                'label'     => 'Traumatologie',
                'label_attr'  => ['class'=>'h3']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
