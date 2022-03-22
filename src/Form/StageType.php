<?php

namespace App\Form;

use App\Entity\Stage;
use App\Entity\Formation;
use App\Form\EntrepriseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('mission')
            ->add('email')
            ->add('typeEntreprise', EntrepriseType::class)
            ->add('typeFormation',EntityType::class, array(
                'class'=>Formation::class ,
                'choice_label'=>'nomLong',
                'multiple'=>true,
                'expanded'=>true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
