<?php

namespace App\Form;

use App\Entity\Borrow;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_borrow', DateType::class, [
                'format' => 'dd-MM-yyyy'
            ])
            ->add('return_dt', DateType::class, [
                'format' => 'dd-MM-yyyy'
            ])
            ->add('reservation_dt', DateType::class, [
                'format' => 'dd-MM-yyyy'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Borrow::class,
        ]);
    }
}
