<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categories/delete/{id}", name="category_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Category $category, EntityManagerInterface $em)
    {
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute("categories");
    }

    /**
     * @Route("/categories/create", name="category_create")
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("categories");
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categories/edit/{id}", name="category_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Category $category, request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("categories");
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
