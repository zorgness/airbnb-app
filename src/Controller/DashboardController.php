<?php

namespace App\Controller;

use App\Entity\Flat;
use App\Form\FlatType;
use App\Entity\ProductImage;
use League\Flysystem\Filesystem;
use League\Flysystem\Visibility;
use App\Repository\FlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\FilesystemException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(FlatRepository $repository): Response
    {
        $user = $this->getUser();
        // $ip = isset($_SERVER['HTTP_CLIENT_IP'])
        // ? $_SERVER['HTTP_CLIENT_IP']
        // : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
        //   ? $_SERVER['HTTP_X_FORWARDED_FOR']
        //   : $_SERVER['REMOTE_ADDR']);

        $flats = $repository->findby(array('owner' => $user));
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'flats' => $flats,

        ]);
    }

    #[Route('/dashboard/flat/new', name: 'dashboard_flat_new')]
    #[Route('/dashboard/flat/{id}', name: 'dashboard_flat_edit') ]
    public function new_and_edit(Flat $flat = null, Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem): Response
    {
        if(!$flat) {
          $flat = new Flat();
        }

        $user = $this->getUser();
        $form = $this->createForm(FlatType::class,$flat);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
          $modify = $flat->getId() !== null;
          $images = $form->get('images')->getData();

          foreach ($images as $image) {

            $file = md5(uniqid()) . "." . $image->guessExtension();
            // to upload localy on '%kernel.project_dir%/public/images/products'
            // $image->move(
            //   $this->getParameter('images_directory'),
            //   $file
            // );

            $filesystem->write( $file,
            file_get_contents($image->getPathName()));



            $productImage = new ProductImage();
            $productImage->setImageName($file);
            $flat->addProductImage($productImage);
          }
          $flat->setOwner($user);
          $entityManager->persist($flat);
          $entityManager->flush();
          $this->addFlash("success", ($modify) ?  'flat have been modified' : 'flat have been added');
          return $this->redirectToRoute('dashboard');
        }


        return $this->render('dashboard/edit.html.twig', [
            'controller_name' => 'DashboardController',
            'flat' => $flat,
            'form' => $form->createView(),
            'toUpdate' => $flat->getId() !== null
        ]);
    }

    #[Route('/dashboard/flat/delete/{id}', name: 'flat_destroy')]
    public function destroy(Flat $flat, Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem): Response
    {
      if($this->isCsrfTokenValid("SUP". $flat->getId(), $request->get('_token')))
      {
        $images = $flat->getProductImages();
        foreach ($images as $image) {
          # code...
          $name = $image->getImageName();
          $exist = $filesystem->fileExists($name);
          if ($exist === true) {

              $filesystem->delete($name);

          }

          // to delete localy
          // unlink($this->getParameter('images_directory'). '/' . $name);
        }
        $entityManager->remove($flat);
        $entityManager->flush();


        $this->addFlash("success", 'flat have been deleted');
        return $this->redirectToRoute('dashboard');
      }
    }

    #[Route('/dashboard/flat/delete-image/{id}', name: 'image_destroy')]
    public function deleteImageAction(ProductImage $image, Request $request, EntityManagerInterface $entityManager, Filesystem $filesystem)
    {
        $flat = $image->getFlat();

      if($this->isCsrfTokenValid("SUP". $image->getId(), $request->get('_token')))
      {
        $name = $image->getImageName();
        $filesystem->delete($name);

        // unlink($this->getParameter('images_directory'). '/' . $name);
        $entityManager->remove($image);
        $entityManager->flush();
        $this->addFlash("success", 'image have been deleted');
        return $this->redirectToRoute('dashboard_flat_edit', array('id' => $flat->getId()));
      }
    }
}
