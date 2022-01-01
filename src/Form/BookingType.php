<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Booking;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\DataTransformer\DateTimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['data'];
        // $user = $user->getIdUser();
        // dd($user);
        $builder
            ->add('title', TextType::class, array
                (
                    'attr' => 
                        [
                            'class' => 'form-control input-inline'
                        ],
                    'label'=>'Titre',
                )
            )
            ->add('jauge', IntegerType::class, array
                (
                    'attr' => 
                        [
                            'class' => 'form-control input-inline'
                        ],
                    'label'=>'Nbr de places max',
                    'empty_data' => '10'
                )
            )
            ->add('start', DateTimeType::class, array
                    (
                        'widget'=> 'single_text',
                        'required' => true,
                        'attr' => 
                            [
                                'class' => 'input-inline datetimepicker',
                                'data-provide' => 'datetimepicker',
                                'format'=> 'dd/MM/yyyy HH:mm',
                                'input' => 'string',
                                'input_format' => 'y-M-d HH:mm:ss'
                            ],
                        'html5'=> false,
                        'format'=> 'dd/MM/yyyy HH:mm', 
                        'label'=>'Date de début'                        
                    )
                )
            ->add('end', DateTimeType::class, array
                (
                    'widget'=> 'single_text',
                    'required' => false,
                    'attr' => 
                        [
                            'class' => 'form-control input-inline datetimepicker',
                            'data-provide' => 'datetimepicker',
                            'format'=> 'dd/MM/yyyy HH:mm',
                            'input' => 'string',
                            'input_format' => 'y-M-d HH:mm:ss'
                        ],
                    'label_attr' => 
                        [
                            'class' => 'col-6',
                        ],                        
                    'html5'=> false,
                    'format'=> 'dd/MM/yyyy HH:mm', 
                    'label'=>'Date de fin'
                )
            )
            // ->add('background_color',ColorType::class,[
            //     'required' => false,
            //     'attr' => 
            //         [
            //             'class' => 'form-control'
            //         ], 
            //     'label'=>'Couleur'
            //     ])
            ->add('description', TextareaType::class,
                [
                'required'   => false,
                'attr' => 
                    [
                        'class' => 'form-control'
                    ],
                ])
            ->add('isFree', ChoiceType::class, array(
                    // 'placeholder' => "Souhaitez vous vérouiller l'atelier ?",
                    'choices' => array(
                        'Les utilisateurs peuvent s\'inscrire (inscription ouverte)' => true, // disponible
                        'Les utilisateurs ne peuvent pas s\'inscrire (inscription verouillée)' => false
                     ),
                     'attr' => 
                         [
                             'class' => 'form-control disponible'
                         ],
                     'label' => "STATUT DE L'ATELIER (Determine si l'atelier' est disponible ou non dans le calendrier)",
                 ))
            ->add('isConfirmed', ChoiceType::class, array(
                    // 'placeholder' => "Souhaitez vous valider l'atelier ?",
                    'choices' => array(
                        'OUI' => true,
                        'NON' => false
                     ),
                     'attr' => 
                         [
                             'class' => 'form-control confirmation'
                         ],
                     'label' => 'Souhaitez vous valider l\'atelier ?',
                 ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
