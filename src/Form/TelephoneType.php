<?php

namespace App\Form;

use App\Entity\Telephone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TelephoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mobile', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Entrez un numéro de téléphone portable',
                    ]
            ])
            ->add('telephone', TextType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Entrez un numéro de téléphone fixe',
                    ]
            ])
            ->add('mail', EmailType::class, [
                'attr' => 
                    [   'class'       => 'form-control',
                        'placeholder' => 'Entrez un mail valide',
                    ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Telephone::class,
        ]);
    }
}
