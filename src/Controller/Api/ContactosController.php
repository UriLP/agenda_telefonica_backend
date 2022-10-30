<?php
namespace App\Controller\Api;
header("Access-Control-Allow-Origin: *");

use App\Entity\Contacto;
use App\Form\Type\ContactoFormType;
use App\Repository\ContactoRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

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
    $contacto = new Contacto();
    $form = $this->createForm(ContactoFormType::class, $contacto);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($contacto);
      $em->flush();
      return $contacto;
    }
    return $form;
  }

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




}


