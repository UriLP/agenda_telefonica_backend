<?php
namespace App\Controller\Api;
header("Access-Control-Allow-Origin: *");

use App\Entity\Contacto;
use App\Entity\OtrosNumeros;
use App\Form\Model\ContactoDto;
use App\Form\Model\OtrosNumerosDto;
use App\Form\Type\ContactoFormType;
use App\Repository\ContactoRepository;
use App\Repository\OtrosNumerosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactosController extends AbstractFOSRestController
{
  // http://localhost:8000/api/contactos
  /**
   * @Rest\Get(path="/contactos")
   * @Rest\View(serializerGroups={"contacto"}, serializerEnableMaxDepthChecks=true)
   *
   */
  public function getActions(
    ContactoRepository $contactoRepository,
  ) {
    return $contactoRepository->findAll();
  }

  /**
   * @Rest\Post(path="/contactos")
   * @Rest\View(serializerGroups={"contacto"}, serializerEnableMaxDepthChecks=true)
   *
   */
  public function postAction(
    EntityManagerInterface $em,
    Request $request
  )
  {
    $contactoDto = new ContactoDto();
    $form = $this->createForm(ContactoFormType::class, $contactoDto);
    $form->handleRequest($request);
    if (!$form->isSubmitted()) {
      return new Response('', Response::HTTP_BAD_REQUEST);
    }
    if ($form->isValid()) {
      $contacto = new Contacto();
      $contacto->setName($contactoDto->name);
      $contacto->setNumero($contactoDto->numero);
      $contacto->setApellido($contactoDto->apellido);
      $contacto->setDireccion($contactoDto->direccion);
      $contacto->setEmail($contactoDto->email);

      $em->persist($contacto);
      $em->flush();
      return $contacto;
    }
    return $form;
  }

  // Esta funcion no se usa en el front-end por cambios en el ContactoFormType
  /**
   * @Rest\Patch(path="/contactos/{id}")
   * @Rest\View(serializerGroups={"contacto"}, serializerEnableMaxDepthChecks=true)
   *
   */
  public function patchAction(
    EntityManagerInterface $em,
    Request $request,
    Contacto $contacto
  )
  {
    $form = $this->createForm(ContactoFormType::class, $contacto, ['method' => 'PATCH']);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($contacto);
      $em->flush();
      return $contacto;
    }
    return $form;
  }

  /**
   * @Rest\Delete(path="/contactos/{id}")
   * @Rest\View(serializerGroups={"contacto"}, serializerEnableMaxDepthChecks=true)
   *
   */
  public function deleteAction(
    EntityManagerInterface $em,
    Contacto $contacto
  )
  {
    $em->remove($contacto);
    $em->flush();
    return $contacto;
  }

  /**
   * @Rest\Post(path="/contactos/{id}", requirements={"id"="\d+"})
   * @Rest\View(serializerGroups={"contacto"}, serializerEnableMaxDepthChecks=true)
   *
   */
  public function editAction(
    int $id,
    EntityManagerInterface $em,
    ContactoRepository $contactoRepository,
    OtrosNumerosRepository $otrosNumerosRepository,
    Request $request
  )
  {
    $contacto = $contactoRepository->find($id);
    if (!$contacto) {
      throw $this->createNotFoundException('No existe el contacto');
    }
    $contactoDto = ContactoDto::createFromContacto($contacto);

    $originalOtrosNumeros = new ArrayCollection();

    foreach ($contacto->getOtrosNumeros() as $otrosNumeros) {
      $otrosNumerosDto = OtrosNumerosDto::createFromOtrosNumeros($otrosNumeros);
      $contactoDto->otrosNumeros[] = $otrosNumerosDto;
      $originalOtrosNumeros->add($contactoDto);
    }
    
    $form = $this->createForm(ContactoFormType::class, $contactoDto);
    $form->handleRequest($request);
    if (!$form->isSubmitted()) {
      return new Response('Error submit', Response::HTTP_BAD_REQUEST);
    }
    if ($form->isValid()) {
      // Remove otros numeros
      foreach ($originalOtrosNumeros as $originalOtrosNumerosDto) {
        if (!in_array($originalOtrosNumerosDto, $contactoDto->otrosNumeros)) {
          $otrosNumeros = $otrosNumerosRepository->find($originalOtrosNumerosDto->id ?? 1);
          $contacto->removeOtrosNumero($otrosNumeros);
        }
      }

      // Add otros numeros
      foreach ($contactoDto->otrosNumeros as $newOtrosNumerosDto) {
        if (!$originalOtrosNumeros->contains($newOtrosNumerosDto)) {
          $otrosNumeros = $otrosNumerosRepository->find($newOtrosNumerosDto->id ?? 0);
          if (!$otrosNumeros) {
            $otrosNumeros = new OtrosNumeros();
            $otrosNumeros->setTelefono($newOtrosNumerosDto->telefono);
            $em->persist($otrosNumeros);
          }
          $contacto->addOtrosNumero($otrosNumeros);
        }
      }
      $contacto->setName($contactoDto->name);
      $contacto->setApellido($contactoDto->apellido);
      $contacto->setNumero($contactoDto->numero);
      $contacto->setEmail($contactoDto->email);
      $contacto->setDireccion($contactoDto->direccion);

      $em->persist($contacto);
      $em->flush();
      $em->refresh($contacto);

      return $contacto;
    }
    return $form;
  }




}


