<?php

namespace App\Form;

use App\Entity\TypeFormation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class TypeFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle', TextType::class, [
            'label' => 'Libellé du Type de Formation',
            'attr' => [
                'placeholder' => 'Entrez le libellé du type de formation',
                'class' => 'form-control',
            ],
            'required' => true, // Validation côté client
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeFormation::class,
        ]);
    }
}
