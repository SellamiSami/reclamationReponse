<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ReclamtionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_reclamation')
            ->add('description_reclamation')        
            ->add('type_reclamation',ChoiceType::class,[
               'choices'  =>[
                    'Medecin' => "medecin",
                    'produit' => "produit",
                    'musique' => "musique",
               ],
                'expanded' => false,
                'multiple' => false,
                ])
            ->add('date')
            ->add('etat_reclamation',ChoiceType::class,[
                'choices'  =>[
                     'traité' => "medecin",
                     'non traité' => "produit",
                     
                ],
                 'expanded' => false,
                 'multiple' => false,
                 ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}

