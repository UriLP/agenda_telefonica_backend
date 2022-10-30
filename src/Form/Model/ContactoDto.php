<?php

namespace App\Form\Model;

use App\Entity\Contacto;

class ContactoDto {
  public $id;
  public $name;
  public $numero;
  public $apellido;
  public $direccion;
  public $email;
  public $otrosNumeros;

  public function __construct()
  {
    $this->otrosNumeros = [];
  }

  public static function createFromContacto(Contacto $contacto): self
  {
    $dto = new self();
    $dto->name = $contacto->getName();
    $dto->numero = $contacto->getNumero();
    $dto->apellido = $contacto->getApellido();
    $dto->direccion = $contacto->getDireccion();
    $dto->email = $contacto->getEmail();

    return $dto;
  }
}
