<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    #[Route('/register',  name: 'register')]
    public function new( Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, Filesystem $filesystem): Response
    {

      $user = new Account();
      $form = $this->createForm(RegistrationType::class,$user);

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
        $hashedPassword = $passwordHasher->hashPassword(
          $user,
          $user->getPassword()
      );
        $image = $form->get('image')->getData();
        if($image) {

          $file = md5(uniqid()) . "." . $image->guessExtension();
          $filesystem->write( $file,
          file_get_contents($image->getPathName()));
          $user->setImage($file);

        } else {
          $user->setImage('images.png');
        }


        $user->setPassword($hashedPassword);
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash("success", 'user have been registred');
        return $this->redirectToRoute('flats');
      }
        return $this->render('registration/register.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/login', name: 'login')]
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/login.html.twig', [
            'controller_name' => 'RegistrationController',
            'lastUsername' => $lastUsername,
            'error' => $error,


        ]);

    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
