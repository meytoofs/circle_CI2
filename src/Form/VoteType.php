<?php

namespace App\Form;

use App\Entity\IdeaProposition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalScore', TextType::class, [
                'label' => true,
                'required' => true,
                'label' => 'Votre note entre 0/100*',
                'attr' => [
                    'placeholder' => '10..20..100',
                ]
            ])
            ->add('sauvegarder', SubmitType::class, [
                'attr' => [
                    'class' => 'coucou',
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IdeaProposition::class,
        ]);
    }
}
