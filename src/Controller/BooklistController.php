<?php

namespace App\Controller;

use App\Entity\Booklist;
use App\Repository\BooklistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BooklistController extends AbstractController
{
    /**
     * @Route("/booklists", name="booklists")
     */
    public function index(BooklistRepository $booklistRepository)
    {
        $booklists = $booklistRepository->findAll();

        return $this->render('booklist/index.html.twig', [
            'booklists' => $booklists,
        ]);
    }

    /**
     * @Route("/booklists/delete/{id}", name="booklist_delete")
     */
    public function delete(Booklist $booklist, EntityManagerInterface $em)
    {
        $em->remove($booklist);
        $em->flush();

        return $this->redirectToRoute("booklists");
    }
}
