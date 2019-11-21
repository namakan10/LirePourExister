<?php

namespace App\Form;

use App\Entity\BookSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BookSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => "Titre du livre"
                ]
            ])
            ->add('availability', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices' => [
                    "Toutes les disponibilités" => "",
                    "En lecture" => "En lecture",
                    "En lecture & prêt" => "En lecture & prêt",
                ]
            ])
            ->add('language', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices' => [
                    "Toutes les langues" => "",
                    "Français" => "Français",
                    "Bambara" => "Bambara",
                    "Anglais" => "Anglais",
                    "Russe" => "Russe",
                    "Espagnol" => "Espagnol",
                    "Mandarin" => "Mandarin"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BookSearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
