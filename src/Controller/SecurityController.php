<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="admin_security_login")
     */
    public function login(FormFactoryInterface $factory)
    {
        $form = $factory->createNamed('', LoginType::class);

        return $this->render('dashboard/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="admin_security_logout")
     */
    public function logout()
    {
    }
}
