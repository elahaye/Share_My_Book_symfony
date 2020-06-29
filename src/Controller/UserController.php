<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/users/delete/{id}", name="user_delete")
     */
    public function delete(User $user, EntityManagerInterface $em)
    {
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("users");
    }
}
