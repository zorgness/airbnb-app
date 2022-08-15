<?php

namespace App\Form;

use App\Entity\Flat;
use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('address')
            ->add('pricePerDay')
            ->add('description')
            ->add('imageFile', FileType::class, ['required' => false])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Flat::class,
        ]);
    }
}
