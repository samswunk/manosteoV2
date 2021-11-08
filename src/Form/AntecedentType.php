<?php

namespace App\Form;

use App\Entity\Antecedent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AntecedentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orl')
            ->add('neuro')
            ->add('vr')
            ->add('allergie')
            ->add('cardio')
            ->add('digest')
            ->add('uro')
            ->add('gyneco')
            ->add('sommeil')
            ->add('grossesse')
            ->add('vaccin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Antecedent::class,
        ]);
    }
}
