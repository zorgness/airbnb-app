<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\FlatRepository;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FlatController extends AbstractController
{
    #[Route('/', name: 'flats')]
    public function index(FlatRepository $repository): Response
    {
        $flats = $repository->findAll();
        return $this->render('flat/index.html.twig', [
            'controller_name' => 'FlatController',
            'flats' => $flats
        ]);
    }

    #[Route('/flats/{id}', name: 'show_flat')]
    public function show(Request $request, Flat $flat, BookingRepository $bookingRepository): Response
    {

      $booking = new Booking();
      $form = $this->createForm(BookingType::class, $booking);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

          $user = $this->getUser();
          $booking->setFlat($flat);
          $booking->setUserAccount($user);
          $bookingRepository->add($booking, true);
          $owner = $flat->getOwner()->getUsername();
          $this->addFlash("success", "Your request has been send $owner");
          return $this->redirectToRoute('dashboard', [], Response::HTTP_SEE_OTHER);
      }
        return $this->render('flat/show.html.twig', [
            'controller_name' => 'FlatController',
            'flat' => $flat,
            'form' => $form->createView()
        ]);
    }

    #[Route('/template', name: 'template_flat')]
    public function template(): Response
    {

        return $this->render('flat/edit.html.twig', [
            'controller_name' => 'FlatController',

        ]);
    }

}
