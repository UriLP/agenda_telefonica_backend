<?php

namespace App\Form\Model;

use App\Entity\OtrosNumeros;

class OtrosNumerosDto {
  public $id;
  public $telefono;

  public static function createFromOtrosNumeros(OtrosNumeros $otrosNumeros): self
  {
    $dto = new self(
      $otrosNumeros->getId(),
      $otrosNumeros->getTelefono(),
    );

    return $dto;
  }

}
