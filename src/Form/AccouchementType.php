<?php

namespace App\Form;

use App\Entity\Accouchement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccouchementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('difficultes')
            ->add('conditions')
            ->add('peridurale')
            ->add('episiotomie')
            ->add('instrumentalisation')
            ->add('presentation')
            ->add('remarques')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Accouchement::class,
        ]);
    }
}
