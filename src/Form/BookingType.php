<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberPeople', IntegerType::class, ['attr' => [
              'min' => 1

          ]])
            ->add('startDate', DateType::class, [
              'widget' => 'single_text',
              // adds a class that can be selected in JavaScript
              'attr' => ['class' => 'js-datepicker'],
          ])
            ->add('endDate', DateType::class, [
              'widget' => 'single_text',
              // adds a class that can be selected in JavaScript
              'attr' => ['class' => 'js-datepicker'],
          ])
          ->add('accepted')
          ->add('rejected')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
