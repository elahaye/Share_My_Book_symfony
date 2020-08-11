<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="admin_security_login")
     */
    public function login(FormFactoryInterface $factory, AuthenticationUtils $authenticationUtils)
    {
        $form = $factory->createNamed('', LoginType::class);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if (isset($error)) {
            $error = "Les identifiants entrés ne sont pas valides, veuillez réessayer.";
        }

        return $this->render('dashboard/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="admin_security_logout")
     */
    public function logout()
    {
    }
}
