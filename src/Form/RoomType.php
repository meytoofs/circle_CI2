<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Contracts\Translation\TranslatorInterface;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => true,
                'required' => true,
                'label' => 'form_chat.nom_room',
                'attr' => [
                    'placeholder' => 'form_chat.placeholder_nom',
                ]
            ])
            ->add('type', TextType::class, [
                'label' => true,
                'required' => true,
                'label' => 'form_chat.type_room',
                'attr' => [
                    'placeholder' => 'form_chat.placeholder_type'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
