<?php

namespace App\Form;

use App\Entity\Signe;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SigneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label'=>'Nom du Signe'])
            ->add('description', TextType::class, ['label'=>'Description du Signe'])
            ->add('dateDebut', DateType::class, ['label'=>'Date Début'])
            ->add('dateFin', DateType::class, ['label'=>'Date Fin'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'date_class'=>Signe::class,
        ]);
    }
}
