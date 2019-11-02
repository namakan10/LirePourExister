<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('published_dt')
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
            ->add('number')
            ->add('tome')
            ->add('image', FileType::class, [
                'constraints' => new Image(),
            ])
            ->add('category', EntityType::class, [
                'label' => "Categories",
                'multiple' => true,
                'class' => Category::class
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
