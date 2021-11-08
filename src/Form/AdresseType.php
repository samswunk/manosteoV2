<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresse1', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Entrez une adresse',
                    ],
                'required'      => false
            ])
            ->add('adresse2', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Entrez une adresse',
                    ],
                'required'      => false
            ])
            ->add('codePostal', TextType::class, [
                'attr' => 
                    [   'class'         => 'form-control',
                        'placeholder' => 'Entrez un code postal',
                    ],
                'required'      => false
            ])
            ->add('ville', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Entrez une Ville',
                    ],
                'required'      => false
            ])
            ->add('latitude')
            ->add('longitude')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
