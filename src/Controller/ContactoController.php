<?php
namespace App\Controller;

use App\Entity\Contacto;
use App\Repository\ContactoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController {
// http://localhost/agenda_telefonica_v2/public/index.php/

  /**
   * @Route("/contactos", name="contactos_get")
  */
  public function list(Request $request, ContactoRepository $contactoRepository) {
    $name = $request->get('name', 'Uri');
    $contactos = $contactoRepository->findAll();
    $contactosAsArray = [];
    foreach ($contactos as $contacto) {
      $contactosAsArray[] = [
        'id' => $contacto->getId(),
        'name' => $contacto->getName(),
        'apellido' => $contacto->getApellido(),
        'numero' => $contacto->getNumero(),
        'direccion' => $contacto->getDireccion(),
      ];
    }
    $response = new JsonResponse();
    $response->setData([
      'success' => true,
      'data' => $contactosAsArray,
    ]);
    return $response;
  }

  /**
   * @Route("/contacto/create", name="create_contacto")
  */
  public function createContacto(Request $request, EntityManagerInterface $em) {
    $contacto = new Contacto();
    $response = new JsonResponse();

    $name = $request->get('name', null);
    $apellido = $request->get('apellido', null);
    $numero = $request->get('numero', null);
    $direccion = $request->get('direccion', null);

    if ($name === null) {
      $response->setData([
        'success' => false,
        'message' => 'El campo nombre es requerido',
        'data' => null
      ]);
      return $response;
    } else if ($apellido === null ) {
      $response->setData([
        'success' => false,
        'message' => 'El campo apellido es requerido',
        'data' => null
      ]);
      return $response;
    } else if ($numero === null ) {
      $response->setData([
        'success' => false,
        'message' => 'El campo numero es requerido',
        'data' => null
      ]);
      return $response;
    } else if ($direccion === null ) {
      $response->setData([
        'success' => false,
        'message' => 'El campo direccion es requerido',
        'data' => null
      ]);
      return $response;
    }

    $contacto->setName($name);
    $contacto->setNumero($numero);
    $contacto->setApellido($apellido);
    $contacto->setDireccion($direccion);

    $em->persist($contacto);
    $em->flush();


    $response->setData([
      'success' => true,
      'data' => [
        'id' => $contacto->getId(),
        'name' => $contacto->getName(),
        'numero' => $contacto->getNumero(),
        'apellido' => $contacto->getApellido(),
        'direccion' => $contacto->getDireccion(),
      ]
    ]);
    return $response;
  }

}


