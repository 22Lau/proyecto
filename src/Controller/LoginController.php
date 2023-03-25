<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
       // obtener el error de inicio de sesión si hay alguno
       $error = $authenticationUtils->getLastAuthenticationError();

       // último nombre de usuario ingresado
       $lastUsername = $authenticationUtils->getLastUsername();

       return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
   }

   /**
    * @Route("/authenticate", name="app_authenticate")
    */
   public function authenticate()
   {
       // Esta acción solo se usa para redirigir a la página de inicio después de la autenticación exitosa.
       return $this->redirectToRoute('app_homepage');
   }

   /**
    * @Route("/logout", name="app_logout")
    */
   public function logout()
    {
        // Este método no necesita código, Symfony maneja el cierre de sesión por ti.
    }

}

