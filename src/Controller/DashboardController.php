<?php

namespace App\Controller;

use App\Repository\FlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(FlatRepository $repository): Response
    {
        $user = $this->getUser();
        $flats = $repository->findby(array('owner' => $user));
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'flats' => $flats
        ]);
    }
}
