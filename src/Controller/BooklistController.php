<?php

namespace App\Controller;

use App\Entity\Booklist;
use App\Repository\BooklistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BooklistController extends AbstractController
{
    /**
     * @Route("/booklists", name="booklists")
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Booklist $booklist, EntityManagerInterface $em)
    {
        $em->remove($booklist);
        $em->flush();

        return $this->redirectToRoute("booklists");
    }
}
