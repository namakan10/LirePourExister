<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title')
            ->add('author')
            ->add('published_dt', DateType::class, [
                'format' => "dd-MM-yyyy"
            ])
            ->add('availability', ChoiceType::class, [
                'choices' => [
                    "En lecture" => "En lecture",
                    "En lecture & prêt" => "En lecture & prêt",
                ]
            ])
            ->add('isbnIssn')
            ->add('language', ChoiceType::class, array(
                'choices' => array(
                    "Français" => "Français",
                    "Bambara" => "Bambara",
                    "Anglais" => "Anglais",
                    "Russe" => "Russe",
                    "Espagnol" => "Espagnol",
                    "Mandarin" => "Mandarin"
                )
            ))
            ->add('descritpion')
            ->add('editor')
            ->add('nbreCopies')
            ->add('nbrePage')
            ->add('imageFile', VichImageType::class)
            ->add('category', EntityType::class, [
                'label' => "Categories",
                'multiple' => true,
                'class' => Theme::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
