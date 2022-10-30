<?php

namespace App\Form\Type;

use App\Form\Model\OtrosNumerosDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OtrosNumerosFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('id', TextType::class)
      ->add('telefono', TextType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => OtrosNumerosDto::class,
    ]);
  }

  public function getBlockPrefix()
  {
    return '';
  }

  public function getName()
  {
    return '';
  }
}
