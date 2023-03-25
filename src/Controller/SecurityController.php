<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request)
    {
        $error = $request->getSession()->get('login_error');

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $request->getSession()->get('_security.last_username'),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // The security layer will intercept this request
    }
}
