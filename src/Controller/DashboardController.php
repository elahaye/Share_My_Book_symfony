<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\BooklistRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(UserRepository $userRepository, BooklistRepository $booklistRepository)
    {
        $users = $userRepository->findBy(array(), array("registrationDate" => "DESC"));
        $booklists = $booklistRepository->findBy(array(), array("createdAt" => "DESC"));

        return $this->render('dashboard/index.html.twig', [
            'users' => $users,
            'booklists' => $booklists
        ]);
    }
}
