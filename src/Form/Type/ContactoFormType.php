<?php

namespace App\Form\Type;

use App\Entity\Contacto;
use App\Form\Model\ContactoDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactoFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class)
      ->add('numero', TextType::class)
      ->add('apellido', TextType::class)
      ->add('direccion', TextType::class)
      ->add('email', TextType::class)
      ->add('otrosNumeros', CollectionType::class, [
        'allow_add' => true,
        'allow_delete' => true,
        'entry_type' => OtrosNumerosFormType::class
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => ContactoDto::class,
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
