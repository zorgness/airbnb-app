<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Repository\FlatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function show(Flat $flat): Response
    {

        return $this->render('flat/show.html.twig', [
            'controller_name' => 'FlatController',
            'flat' => $flat
        ]);
    }
}
