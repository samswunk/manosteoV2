<?php

namespace App\Form;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tarif', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Montant',
                    ],
                'required'      => true
            ])
            // ->add('paiement', ChoiceType::class, [
            //     'required' => true,
            //     'expanded' => true,
            //     'multiple' => false,
            //     // 'label_html' => true,
            //     'attr' =>   
            //         [
            //             'class' => 'form-check-input moyenPaiement'
            //         ],
            //     'data' => 'Carte bleue',
                
            //     'choices' => array(
            //         'Chèque' => 1, // disponible
            //         'Espèce' => 0,
            //         'Carte bleue' => 2
            //      ),
            //      'label' => 'Moyen de paiement'
            //  ])
            ->add('numeroCheque', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Numéro de chèque',
                    ],
                'required'      => false
            ])
            ->add('regler',CheckboxType::class,[
                'label' => 'Consultation réglée',
           ])
            ->add('date', DateTimeType::class, [
                'widget'=> 'single_text',
                'required' => true,
                'attr' => 
                    [
                        'class'         => 'form-control datepicker',
                        'data-provide'  => 'datepicker',
                        'format'        => 'dd/MM/yyyy',
                        'input'         => 'string',
                        'input_format'  => 'y-M-d', 
                        'value'         => date('d/m/Y')
                    ],
                'html5'=> false,
                'format'=> 'dd/MM/yyyy', 
                'label'=>'Date de la facture'                        
            ])
            // ->add('patient', EntityType::class, [
            //     // looks for choices from this entity
            //     'class' => Patient::class,
            //     'choice_label' => function ($user) 
            //         { return $user->getId()." " . $user->getNom()." " . $user->getPrenom(); },
            //     'attr' => 
            //         [
            //             'class' => 'form-control',
            //         ],
            //     // used to render a select box, check boxes or radios
            //     'multiple' => false,
            //     'expanded' => false
            // ])
            // ->add('numero', TextType::class, [
            //     'attr' => 
            //         [   'class'       => 'form-control',
            //             'placeholder' => 'Numéro de la facture',
            //         ]
            // ])
            ->add('impression',CheckboxType::class,[
                'label'     => 'Impression',
                'required'  => false
           ])
        ;
        // We modify the form before defining the datas
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            //We retrieve the entity related to the form
            $entity = $event->getData();
            $form = $event->getForm();
            // if ($entity) dd($event->getData(),$entity->getPaiement());
            $form            ->add('paiement', ChoiceType::class, [
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                // 'label_html' => true,
                'attr' =>   
                    [
                        'class' => 'form-check-input moyenPaiement'
                    ],
                'data' => $entity ? $entity->getPaiement() : 2,
                'choices' => array(
                    'Chèque' => 1, // disponible
                    'Espèce' => 0,
                    'Carte bleue' => 2
                 ),
                 'label' => 'Moyen de paiement'
            ]);
        });        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
