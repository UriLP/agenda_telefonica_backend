<?php

namespace App\Serializer;

use App\Entity\Contacto;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ContactoNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($contacto, $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($contacto, $format, $context);

        $data['name'] = $contacto->getName();
        $data['numero'] = $contacto->getNumero();
        $data['apellido'] = $contacto->getApellido();
        $data['direccion'] = $contacto->getDireccion();
        $data['email'] = $contacto->getEmail();

        return $data;
    }

    public function supportsNormalization($data, $format = null, array $context = []):bool
    {
        return $data instanceof Contacto;
    }
}

