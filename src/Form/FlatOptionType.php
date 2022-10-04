<?php

namespace App\Form;

use App\Entity\FlatOption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FlatOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('wifi', CheckboxType::class, [
              'label'    => 'wifi',
              'required' => false,
          ])
            ->add('parking', CheckboxType::class, [
              'label'    => 'free parking',
              'required' => false,
          ])
            ->add('workingPlace', CheckboxType::class, [
              'label'    => 'working space',
              'required' => false,
          ])
            ->add('animal', CheckboxType::class, [
              'label'    => 'animals allowed',
              'required' => false,
          ])
            ->add('kitchen', CheckboxType::class, [
              'label'    => 'kitchen',
              'required' => false,
          ])
            ->add('tv', CheckboxType::class, [
              'label'    => 'tv',
              'required' => false,
          ])
            ->add('aircon', CheckboxType::class, [
              'label'    => 'aircon',
              'required' => false,
          ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FlatOption::class,
        ]);
    }
}
