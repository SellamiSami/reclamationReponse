<?php

namespace App\Form;

use App\Entity\Patient;
//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
            'attr' => [
                'placeholder'=>'Entrer votre nom',
                 'class' => 'form-control form-control-user',
//                 'id' => 'exampleFirstName'
    ]])
            ->add('prenom',TextType::class,[
                'attr' => [
                    'placeholder'=>'Entrer votre prenom',
                    'class' => 'form-control form-control-user',
//                    'id' => 'exampleLastName'
                ]])
            ->add('email',TextType::class,[
                'attr' => [
                    'placeholder'=>'Entrer votre email',
                    'class' => 'form-control form-control-user',
//                    'id' => 'exampleInputEmail'
                ]])
            ->add('motpasse',TextType::class,[
                'attr' => [
                    'placeholder'=>'Entrer votre mot de passe',
                    'class' => 'form-control form-control-user',
//                    'id' => 'exampleInputPassword'
                ]])
            ->add('Register_Account',SubmitType::class,[
                'attr'=> [
                    'class' => 'btn btn-primary btn-user btn-block'
                ]
            ])

        ->add('Update_Account',SubmitType::class,[
        'attr'=> [
            'class' => 'btn btn-primary btn-user btn-block'
        ]
    ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
