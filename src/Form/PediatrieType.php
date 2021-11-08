<?php

namespace App\Form;

use App\Entity\Pediatrie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PediatrieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taille')
            ->add('poids')
            ->add('pc')
            ->add('apgar1')
            ->add('apgar5')
            ->add('apgar10')
            ->add('allaitement')
            ->add('tempsAllaitement')
            ->add('remarques')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pediatrie::class,
        ]);
    }
}
