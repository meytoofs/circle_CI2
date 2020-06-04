<?php

namespace App\Form;

use App\Entity\NoteHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('score', TextType::class, [
            'label' => true,
            'required' => true,
            'label' => 'Votre note entre 0/100*',
            'attr' => [
                'placeholder' => '10..20..100',
            ]
        ])
        ->add('ideaProposition')
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
            'data_class' => NoteHistory::class,

        ]);
    }
}
